class Command {
    execute() {}
    getId() {}
    getStatus() {}
}

class WebScrapingCommand extends Command {
    constructor(url) {
        super();
        this.id = null;
        this.status = 0;
        this.url = url;
    }

    getId() {
        return this.id;
    }

    getStatus() {
        return this.status;
    }

    getURL() {
        return this.url;
    }

    async execute() {
        const html = await this.download();
        this.parse(html);
        this.complete();
    }

    async download() {
        const response = await fetch(this.getURL());
        const html = await response.text();
        console.log(`WebScrapingCommand: Downloaded ${this.url}`);
        return html;
    }

    parse(html) {
        throw new Error("Method 'parse()' must be implemented.");
    }

    complete() {
        this.status = 1;
        Queue.get().completeCommand(this);
    }
}

class IMDBGenresScrapingCommand extends WebScrapingCommand {
    constructor() {
        super("https://www.imdb.com/feature/genre/");
    }

    parse(html) {
        const regex = /href="(https:\/\/www.imdb.com\/search\/title\?genres=.*?)"/g;
        const matches = [...html.matchAll(regex)];
        console.log(`IMDBGenresScrapingCommand: Discovered ${matches.length} genres.`);
        matches.forEach(match => {
            Queue.get().add(new IMDBGenrePageScrapingCommand(match[1]));
        });
    }
}

class IMDBGenrePageScrapingCommand extends WebScrapingCommand {
    constructor(url, page = 1) {
        super(url);
        this.page = page;
    }

    getURL() {
        return `${this.url}?page=${this.page}`;
    }

    parse(html) {
        const regex = /href="(\/title\/.*?\/)\?ref_=adv_li_tt"/g;
        const matches = [...html.matchAll(regex)];
        console.log(`IMDBGenrePageScrapingCommand: Discovered ${matches.length} movies.`);
        matches.forEach(match => {
            const url = `https://www.imdb.com${match[1]}`;
            Queue.get().add(new IMDBMovieScrapingCommand(url));
        });

        if (html.includes('Next &#187;</a>')) {
            Queue.get().add(new IMDBGenrePageScrapingCommand(this.url, this.page + 1));
        }
    }
}

class IMDBMovieScrapingCommand extends WebScrapingCommand {
    parse(html) {
        const regex = /<h1 itemprop="name" class="">(.*?)<\/h1>/;
        const match = html.match(regex);
        if (match) {
            const title = match[1];
            console.log(`IMDBMovieScrapingCommand: Parsed movie ${title}.`);
        }
    }
}

class Queue {
    constructor() {
        this.db = new Map();
        this.lastId = 0;
    }

    isEmpty() {
        return ![...this.db.values()].some(command => command.status === 0);
    }

    add(command) {
        this.lastId++;
        command.id = this.lastId;
        this.db.set(this.lastId, command);
    }

    getCommand() {
        for (let command of this.db.values()) {
            if (command.status === 0) {
                return command;
            }
        }
        return null;
    }

    completeCommand(command) {
        if (this.db.has(command.getId())) {
            this.db.get(command.getId()).status = command.getStatus();
        }
    }

    async work() {
        while (!this.isEmpty()) {
            const command = this.getCommand();
            if (command === null) {
                break;
            }
            await command.execute();
        }
    }

    static get() {
        if (!Queue.instance) {
            Queue.instance = new Queue();
        }
        return Queue.instance;
    }
}

// Client Code
const queue = Queue.get();
if (queue.isEmpty()) {
    queue.add(new IMDBGenresScrapingCommand());
}

queue.work();
