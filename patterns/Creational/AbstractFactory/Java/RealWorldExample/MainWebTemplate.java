package patterns.Creational.AbstractFactory.Java.RealWorldExample;

// Abstract Factory for creating templates
interface TemplateFactory {
    TitleTemplate createTitleTemplate();
    PageTemplate createPageTemplate();
    TemplateRenderer getRenderer();
}

// Concrete Factory for Twig templates
class TwigTemplateFactory implements TemplateFactory {
    @Override
    public TitleTemplate createTitleTemplate() {
        return new TwigTitleTemplate();
    }

    @Override
    public PageTemplate createPageTemplate() {
        return new TwigPageTemplate(createTitleTemplate());
    }

    @Override
    public TemplateRenderer getRenderer() {
        return new TwigRenderer();
    }
}

// Concrete Factory for PHPTemplate
class PHPTemplateFactory implements TemplateFactory {
    @Override
    public TitleTemplate createTitleTemplate() {
        return new PHPTemplateTitleTemplate();
    }

    @Override
    public PageTemplate createPageTemplate() {
        return new PHPTemplatePageTemplate(createTitleTemplate());
    }

    @Override
    public TemplateRenderer getRenderer() {
        return new PHPTemplateRenderer();
    }
}

// Abstract product for title templates
interface TitleTemplate {
    String getTemplateString();
}

// Concrete product for Twig title templates
class TwigTitleTemplate implements TitleTemplate {
    @Override
    public String getTemplateString() {
        return "<h1>{{ title }}</h1>";
    }
}

// Concrete product for PHPTemplate title templates
class PHPTemplateTitleTemplate implements TitleTemplate {
    @Override
    public String getTemplateString() {
        return "<h1><?= $title; ?></h1>";
    }
}

// Abstract product for page templates
interface PageTemplate {
    String getTemplateString();
}

// Base page template, used by both variants
abstract class BasePageTemplate implements PageTemplate {
    protected TitleTemplate titleTemplate;

    public BasePageTemplate(TitleTemplate titleTemplate) {
        this.titleTemplate = titleTemplate;
    }
}

// Concrete page template for Twig
class TwigPageTemplate extends BasePageTemplate {
    public TwigPageTemplate(TitleTemplate titleTemplate) {
        super(titleTemplate);
    }

    @Override
    public String getTemplateString() {
        String renderedTitle = titleTemplate.getTemplateString();

        return "<div class=\"page\">" +
                renderedTitle +
                "<article class=\"content\">{{ content }}</article>" +
                "</div>";
    }
}

// Concrete page template for PHPTemplate
class PHPTemplatePageTemplate extends BasePageTemplate {
    public PHPTemplatePageTemplate(TitleTemplate titleTemplate) {
        super(titleTemplate);
    }

    @Override
    public String getTemplateString() {
        String renderedTitle = titleTemplate.getTemplateString();

        return "<div class=\"page\">" +
                renderedTitle +
                "<article class=\"content\">" + "<?php echo $content; ?>" + "</article>" +
                "</div>";
    }
}

// Interface for template renderers
interface TemplateRenderer {
    String render(String templateString, String title, String content);
}

// Concrete renderer for Twig
class TwigRenderer implements TemplateRenderer {
    @Override
    public String render(String templateString, String title, String content) {
        // Simulate rendering using Twig syntax
        return templateString.replace("{{ title }}", title).replace("{{ content }}", content);
    }
}

// Concrete renderer for PHPTemplate
class PHPTemplateRenderer implements TemplateRenderer {
    @Override
    public String render(String templateString, String title, String content) {
        // Using basic string replace as a simulation of PHPTemplate rendering
        return templateString.replace("<?= $title; ?>", title).replace("<?php echo $content; ?>", content);
    }
}

// Client code for creating and rendering a page
class Page {
    private String title;
    private String content;

    public Page(String title, String content) {
        this.title = title;
        this.content = content;
    }

    // Render page using the factory
    public String render(TemplateFactory factory) {
        PageTemplate pageTemplate = factory.createPageTemplate();
        TemplateRenderer renderer = factory.getRenderer();

        return renderer.render(pageTemplate.getTemplateString(), title, content);
    }
}

public class MainWebTemplate {
    public static void main(String[] args) {
        Page page = new Page("Sample Page", "This is the body of the page.");

        System.out.println("Testing actual rendering with the PHPTemplate factory:");
        System.out.println(page.render(new PHPTemplateFactory()));
        System.out.println();

        // Uncomment the following if you have Twig rendering logic implemented.
        // System.out.println("Testing rendering with the Twig factory:");
        // System.out.println(page.render(new TwigTemplateFactory()));
    }
}
