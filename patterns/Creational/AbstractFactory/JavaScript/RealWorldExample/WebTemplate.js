// TemplateFactory.js - Abstract Factory for creating templates
class TemplateFactory {
    createTitleTemplate() {
      throw new Error("Method 'createTitleTemplate()' must be implemented.");
    }
  
    createPageTemplate() {
      throw new Error("Method 'createPageTemplate()' must be implemented.");
    }
  
    getRenderer() {
      throw new Error("Method 'getRenderer()' must be implemented.");
    }
  }
  
  // TwigTemplateFactory.js - Concrete Factory for Twig templates
  class TwigTemplateFactory extends TemplateFactory {
    createTitleTemplate() {
      return new TwigTitleTemplate();
    }
  
    createPageTemplate() {
      return new TwigPageTemplate(this.createTitleTemplate());
    }
  
    getRenderer() {
      return new TwigRenderer();
    }
  }
  
  // PHPTemplateFactory.js - Concrete Factory for PHP templates
  class PHPTemplateFactory extends TemplateFactory {
    createTitleTemplate() {
      return new PHPTemplateTitleTemplate();
    }
  
    createPageTemplate() {
      return new PHPTemplatePageTemplate(this.createTitleTemplate());
    }
  
    getRenderer() {
      return new PHPTemplateRenderer();
    }
  }
  
  // TitleTemplate.js - Abstract product interface for title templates
  class TitleTemplate {
    getTemplateString() {
      throw new Error("Method 'getTemplateString()' must be implemented.");
    }
  }
  
  // TwigTitleTemplate.js - Concrete product for Twig title templates
  class TwigTitleTemplate extends TitleTemplate {
    getTemplateString() {
      return "<h1>{{ title }}</h1>";
    }
  }
  
  // PHPTemplateTitleTemplate.js - Concrete product for PHP title templates
  class PHPTemplateTitleTemplate extends TitleTemplate {
    getTemplateString() {
      return "<h1><?= \$title; ?></h1>";
    }
  }
  
  // PageTemplate.js - Abstract product interface for page templates
  class PageTemplate {
    getTemplateString() {
      throw new Error("Method 'getTemplateString()' must be implemented.");
    }
  }
  
  // BasePageTemplate.js - Base class for page templates
  class BasePageTemplate extends PageTemplate {
    constructor(titleTemplate) {
      super();
      this.titleTemplate = titleTemplate;
    }
  }
  
  // TwigPageTemplate.js - Concrete product for Twig page templates
  class TwigPageTemplate extends BasePageTemplate {
    getTemplateString() {
      const renderedTitle = this.titleTemplate.getTemplateString();
      return `
        <div class="page">
          ${renderedTitle}
          <article class="content">{{ content }}</article>
        </div>
      `;
    }
  }
  
  // PHPTemplatePageTemplate.js - Concrete product for PHP page templates
  class PHPTemplatePageTemplate extends BasePageTemplate {
    getTemplateString() {
      const renderedTitle = this.titleTemplate.getTemplateString();
      return `
        <div class="page">
          ${renderedTitle}
          <article class="content"><?= \$content; ?></article>
        </div>
      `;
    }
  }
  
  // TemplateRenderer.js - Abstract renderer for templates
  class TemplateRenderer {
    render(templateString, params = {}) {
      throw new Error("Method 'render()' must be implemented.");
    }
  }
  
  // TwigRenderer.js - Renderer for Twig templates
  class TwigRenderer extends TemplateRenderer {
    render(templateString, params = {}) {
      // Replacing {{ variable }} placeholders with actual arguments
      return templateString.replace(/\{\{ (.*?) \}\}/g, (_, key) => {
        return key in params ? params[key] : '';
      });
    }
  }
  
  // PHPTemplateRenderer.js - Renderer for PHP templates
  class PHPTemplateRenderer extends TemplateRenderer {
    render(templateString, params = {}) {
      let result = templateString;
      for (const [key, value] of Object.entries(params)) {
        result = result.replace(new RegExp(`\\\$${key}`, 'g'), value);
      }
      return result;
    }
  }
  
  
  // Page.js - Client code to render the page with templates
  class Page {
    constructor(title, content) {
      this.title = title;
      this.content = content;
    }
  
    render(factory) {
      const pageTemplate = factory.createPageTemplate();
      const renderer = factory.getRenderer();
      return renderer.render(pageTemplate.getTemplateString(), {
        title: this.title,
        content: this.content,
      });
    }
  }
  
  // Usage
  const page = new Page("Sample Page", "This is the body.");
  
  console.log("Testing rendering with the PHPTemplate factory:");
  console.log(page.render(new PHPTemplateFactory()));
  console.log("\n");
  