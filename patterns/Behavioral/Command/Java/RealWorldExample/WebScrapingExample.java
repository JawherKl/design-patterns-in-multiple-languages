package RealWorldExample;

import java.io.*;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

// Command Interface
interface Command extends Serializable {
    void execute();
    int getId();
    int getStatus();
        void setId(int id);
    }
    
    // Abstract WebScrapingCommand Class
    abstract class WebScrapingCommand implements Command {
        private int id;
        private int status = 0;
        private String url;
    
        public WebScrapingCommand(String url) {
            this.url = url;
        }
    
        public int getId() {
            return id;
        }
    
        public void setId(int id) {
            this.id = id;
        }
    
        public int getStatus() {
            return status;
        }
    
        public void setStatus(int status) {
            this.status = status;
        }
    
        public String getUrl() {
            return url;
        }
    
        @Override
        public void execute() {
            String html = download();
            parse(html);
            complete();
        }
    
        public String download() {
            try (InputStream in = new URL(url).openStream()) {
                String html = new String(in.readAllBytes(), StandardCharsets.UTF_8);
                System.out.println("WebScrapingCommand: Downloaded " + url);
                return html;
            } catch (IOException e) {
                throw new RuntimeException("Failed to download: " + url, e);
            }
        }
    
        abstract void parse(String html);
    
        public void complete() {
            status = 1;
            Queue.getInstance().completeCommand(this);
        }
    }
    
    // IMDBGenresScrapingCommand Class
    class IMDBGenresScrapingCommand extends WebScrapingCommand {
        public IMDBGenresScrapingCommand() {
            super("https://www.imdb.com/feature/genre/");
        }
    
        @Override
        void parse(String html) {
            Pattern pattern = Pattern.compile("href=\\\"(https://www.imdb.com/search/title\\?genres=.*?)\\\"");
            Matcher matcher = pattern.matcher(html);
    
            List<String> genres = new ArrayList<>();
            while (matcher.find()) {
                genres.add(matcher.group(1));
            }
    
            System.out.println("IMDBGenresScrapingCommand: Discovered " + genres.size() + " genres.");
            for (String genre : genres) {
                Queue.getInstance().add(new IMDBGenrePageScrapingCommand(genre));
            }
        }
    }
    
    // IMDBGenrePageScrapingCommand Class
    class IMDBGenrePageScrapingCommand extends WebScrapingCommand {
        private int page;
    
        public IMDBGenrePageScrapingCommand(String url) {
            this(url, 1);
        }
    
        public IMDBGenrePageScrapingCommand(String url, int page) {
            super(url);
            this.page = page;
        }
    
        @Override
        public String getUrl() {
            return super.getUrl() + "?page=" + page;
        }
    
        @Override
        void parse(String html) {
            Pattern pattern = Pattern.compile("href=\\\"(/title/.*?/\\?ref_=adv_li_tt)\\\"");
            Matcher matcher = pattern.matcher(html);
    
            List<String> movies = new ArrayList<>();
            while (matcher.find()) {
                movies.add("https://www.imdb.com" + matcher.group(1));
            }
    
            System.out.println("IMDBGenrePageScrapingCommand: Discovered " + movies.size() + " movies.");
            for (String movieUrl : movies) {
                Queue.getInstance().add(new IMDBMovieScrapingCommand(movieUrl));
            }
    
            if (html.contains("Next &#187;</a>")) {
                Queue.getInstance().add(new IMDBGenrePageScrapingCommand(super.getUrl(), page + 1));
            }
        }
    }
    
    // IMDBMovieScrapingCommand Class
    class IMDBMovieScrapingCommand extends WebScrapingCommand {
        public IMDBMovieScrapingCommand(String url) {
            super(url);
        }
    
        @Override
        void parse(String html) {
            Pattern pattern = Pattern.compile("<h1 itemprop=\"name\" class=\"\">(.*?)</h1>");
            Matcher matcher = pattern.matcher(html);
    
            if (matcher.find()) {
                String title = matcher.group(1);
                System.out.println("IMDBMovieScrapingCommand: Parsed movie " + title);
            }
        }
    }
    
    // Queue Singleton Class
    class Queue {
        private static Queue instance;
        private final Connection db;
    
        private Queue() {
            try {
                db = DriverManager.getConnection("jdbc:sqlite:commands.sqlite");
                Statement statement = db.createStatement();
                statement.executeUpdate(
                    "CREATE TABLE IF NOT EXISTS commands ("+
                        "id INTEGER PRIMARY KEY AUTOINCREMENT,"+
                        "command BLOB,"+
                        "status INTEGER)");
            } catch (SQLException e) {
                throw new RuntimeException("Failed to initialize database", e);
            }
        }
    
        public static Queue getInstance() {
            if (instance == null) {
                instance = new Queue();
            }
            return instance;
        }
    
        public boolean isEmpty() {
            try (PreparedStatement statement = db.prepareStatement(
                "SELECT COUNT(id) FROM commands WHERE status = 0")) {
                ResultSet resultSet = statement.executeQuery();
                return resultSet.next() && resultSet.getInt(1) == 0;
            } catch (SQLException e) {
                throw new RuntimeException("Failed to check queue status", e);
            }
        }
    
        public void add(Command command) {
            try (PreparedStatement statement = db.prepareStatement(
                    "INSERT INTO commands (command, status) VALUES (?, ?)"
                )) {
                ByteArrayOutputStream byteStream = new ByteArrayOutputStream();
                ObjectOutputStream objectStream = new ObjectOutputStream(byteStream);
                objectStream.writeObject(command);
    
                statement.setBytes(1, byteStream.toByteArray());
                statement.setInt(2, command.getStatus());
                statement.executeUpdate();
            } catch (SQLException | IOException e) {
                throw new RuntimeException("Failed to add command to queue", e);
            }
        }
    
        public Command getCommand() {
            try (PreparedStatement statement = db.prepareStatement(
                "SELECT * FROM commands WHERE status = 0 LIMIT 1")) {
                ResultSet resultSet = statement.executeQuery();
    
                if (resultSet.next()) {
                    int id = resultSet.getInt("id");
                    byte[] commandBytes = resultSet.getBytes("command");
    
                    ObjectInputStream objectStream = new ObjectInputStream(new ByteArrayInputStream(commandBytes));
                    Command command = (Command) objectStream.readObject();
                    command.setId(id);

                return command;
            }
            return null;
        } catch (SQLException | IOException | ClassNotFoundException e) {
            throw new RuntimeException("Failed to get command from queue", e);
        }
    }

    public void completeCommand(Command command) {
        try (PreparedStatement statement = db.prepareStatement(
        "UPDATE commands SET status = ? WHERE id = ?"
        )) {
            statement.setInt(1, command.getStatus());
            statement.setInt(2, command.getId());
            statement.executeUpdate();
        } catch (SQLException e) {
            throw new RuntimeException("Failed to update command status", e);
        }
    }

    public void work() {
        while (!isEmpty()) {
            Command command = getCommand();
            if (command == null) break;
            command.execute();
        }
    }
}

// Main Class
public class WebScrapingExample {
    public static void main(String[] args) {
        Queue queue = Queue.getInstance();
        if (queue.isEmpty()) {
            queue.add(new IMDBGenresScrapingCommand());
        }
        queue.work();
    }
}
