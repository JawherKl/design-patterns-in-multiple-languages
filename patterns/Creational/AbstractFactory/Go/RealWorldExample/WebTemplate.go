package main

import (
	"fmt"
	"strings"
)

// TemplateFactory - The Abstract Factory interface declares creation methods for each distinct product type.
type TemplateFactory interface {
	CreateTitleTemplate() TitleTemplate
	CreatePageTemplate() PageTemplate
	GetRenderer() TemplateRenderer
}

// TwigTemplateFactory - Concrete Factory for creating Twig templates.
type TwigTemplateFactory struct{}

func (f *TwigTemplateFactory) CreateTitleTemplate() TitleTemplate {
	return &TwigTitleTemplate{}
}

func (f *TwigTemplateFactory) CreatePageTemplate() PageTemplate {
	return &TwigPageTemplate{BasePageTemplate: BasePageTemplate{titleTemplate: f.CreateTitleTemplate()}}
}

func (f *TwigTemplateFactory) GetRenderer() TemplateRenderer {
	return &TwigRenderer{}
}

// PHPTemplateFactory - Concrete Factory for creating PHP templates.
type PHPTemplateFactory struct{}

func (f *PHPTemplateFactory) CreateTitleTemplate() TitleTemplate {
	return &PHPTemplateTitleTemplate{}
}

func (f *PHPTemplateFactory) CreatePageTemplate() PageTemplate {
	return &PHPTemplatePageTemplate{BasePageTemplate: BasePageTemplate{titleTemplate: f.CreateTitleTemplate()}}
}

func (f *PHPTemplateFactory) GetRenderer() TemplateRenderer {
	return &PHPTemplateRenderer{}
}

// TitleTemplate - The Abstract Product interface for title templates.
type TitleTemplate interface {
	GetTemplateString() string
}

// TwigTitleTemplate - Concrete Product for Twig title templates.
type TwigTitleTemplate struct{}

func (t *TwigTitleTemplate) GetTemplateString() string {
	return "<h1>{{ title }}</h1>"
}

// PHPTemplateTitleTemplate - Concrete Product for PHP title templates.
type PHPTemplateTitleTemplate struct{}

func (t *PHPTemplateTitleTemplate) GetTemplateString() string {
	return "<h1><?= $title; ?></h1>"
}

// PageTemplate - The Abstract Product interface for page templates.
type PageTemplate interface {
	GetTemplateString() string
}

// BasePageTemplate - Base class for page templates.
type BasePageTemplate struct {
	titleTemplate TitleTemplate
}

func (b *BasePageTemplate) GetTemplateString() string {
	return ""
}

// TwigPageTemplate - Concrete Product for Twig page templates.
type TwigPageTemplate struct {
	BasePageTemplate
}

func (p *TwigPageTemplate) GetTemplateString() string {
	renderedTitle := p.titleTemplate.GetTemplateString()
	return fmt.Sprintf(`
		<div class="page">
			%s
			<article class="content">{{ content }}</article>
		</div>
	`, renderedTitle)
}

// PHPTemplatePageTemplate - Concrete Product for PHP page templates.
type PHPTemplatePageTemplate struct {
	BasePageTemplate
}

func (p *PHPTemplatePageTemplate) GetTemplateString() string {
	renderedTitle := p.titleTemplate.GetTemplateString()
	return fmt.Sprintf(`
		<div class="page">
			%s
			<article class="content"><?= $content; ?></article>
		</div>
	`, renderedTitle)
}

// TemplateRenderer - The Abstract Renderer interface for templates.
type TemplateRenderer interface {
	Render(templateString string, arguments map[string]interface{}) string
}

// TwigRenderer - Renderer for Twig templates.
type TwigRenderer struct{}

func (r *TwigRenderer) Render(templateString string, arguments map[string]interface{}) string {
	for key, value := range arguments {
		placeholder := fmt.Sprintf("{{ %s }}", key)
		templateString = strings.ReplaceAll(templateString, placeholder, fmt.Sprintf("%v", value))
	}
	return templateString
}

// PHPTemplateRenderer - Renderer for PHP templates.
type PHPTemplateRenderer struct{}

func (r *PHPTemplateRenderer) Render(templateString string, arguments map[string]interface{}) string {
	for key, value := range arguments {
		placeholder := fmt.Sprintf("<?= $%s; ?>", key)
		templateString = strings.ReplaceAll(templateString, placeholder, fmt.Sprintf("%v", value))
	}
	return templateString
}

// Page - Client code to render the page with templates.
type Page struct {
	title   string
	content string
}

func NewPage(title, content string) *Page {
	return &Page{title: title, content: content}
}

func (p *Page) Render(factory TemplateFactory) string {
	pageTemplate := factory.CreatePageTemplate()
	renderer := factory.GetRenderer()
	return renderer.Render(pageTemplate.GetTemplateString(), map[string]interface{}{
		"title":   p.title,
		"content": p.content,
	})
}

func main() {
	page := NewPage("Sample page", "This is the body.")

	fmt.Println("Testing actual rendering with the PHPTemplate factory:")
	fmt.Println(page.Render(&PHPTemplateFactory{}))
	fmt.Println()

}
