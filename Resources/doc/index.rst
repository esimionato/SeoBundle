# SeoBundle

This bundle ease the way of managing accurate keywords, description, title and so by simply configuring it in a file.

A default section named "defaults" enable a default configuration if the route has not the required configuration.

## Properties
charset: Html5 meta charset.
content-type: Charset for other html standards.
content-language: Main language used within the page.
keywords: Accurate keywords for the page.
description: short content page description (should be less than 60 words).
author: Author name.
title: Title of the page.

Only one between "charset" or "content-type" should be used according to your html doctype.

## Config sample
### Yaml format
Here is a configuration sample in yaml format for app/config/config.yml.
Probably it's a good way to pu it in a separate file and import it in the main configuration file because of it's possible size.

To put the configuration in a external file named "seo.yml" stored in the app/config folder just write in the app/config/config.yml file:

    imports:
        seo: { resource: seo.yml }

To enable twig support:
    seo.twig: ~

or templating support:

    seo.templating: ~

Here is a default sample configuration:

    seo.config:
        defaults:
            charset:            UTF-8
            content-type:       text/html;charset=ISO-8859-1
            content-language:   en
            keywords:           key1, key2, key3, key4, key5
            description:        MyWebsite is great!
            author:             Firstname LASTNAME
            title:              Default title - MyWebsite

The default output will be:

    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
    <meta http-equiv="content-language" content="en" />
    <meta name="keywords" content="key1, key2, key3, key4, key5" />
    <meta name="description" content="MyWebsite is great!" />
    <meta name="author" content="Firstname LASTNAME" />
    <title>Default title - MyWebsite</title>

To override defaults parameters, put every desired route names under the "routing" section. A non defined parameter will be replaced by the one in the default section if any.

    seo.config:
        routing:
            route_name_1:
                keywords:           alternatekey1, alternatekey2
                description:        Alternate description for this page.
            route_name_2:
                title:              Route name 2 page title

The complete config sample:

    seo.twig: ~
    seo.config:
        defaults:
            charset:            UTF-8
            content-type:       text/html;charset=ISO-8859-1
            content-language:   en
            keywords:           key1, key2, key3, key4, key5
            description:        MyWebsite is great!
            author:             Firstname LASTNAME
            title:              Default title - MyWebsite
        routing:
            route_name_1:
                keywords:           alternatekey1, alternatekey2
                description:        Alternate description for this page.
            route_name_2:
                title:              Route name 2 page title

## Enable in views
### Twig
Put in the main layout (src/Application/YourBundle/Resources/views/layout.html.twig) seo tags to enable auto fill.

    {% seo "charset" %}
    {% seo "content-type" %}
    {% seo "content-language" %}
    {% seo "keywords" %}
    {% seo "description" %}
    {% seo "author" %}
    
## Declaring services

### Xml format
Just copy and paste this configuration file below in the src/Application/YourBundle/Resources/config folder.

    <?xml version="1.0" encoding="UTF-8"?>

    <container xmlns="http://www.symfony-project.org/schema/dic/services"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.symfony-project.org/schema/dic/services http://www.symfony-project.org/schema/dic/services/services-1.0.xsd">

        <parameters>
            <parameter key="seo.meta.class">Bundle\SeoBundle\Meta</parameter>
        </parameters>

        <services>
            <service id="seo.meta.keywords" class="%seo.meta.class%">
                <tag name="seo" alias="keywords" />
                <argument type="service" id="service_container" />
                <argument type="string">keywords</argument>
            </service>
            
            <service id="seo.meta.description" class="%seo.meta.class%">
                <tag name="seo" alias="description" />
                <argument type="service" id="service_container" />
                <argument type="string">description</argument>
            </service>
            
            <service id="seo.meta.author" class="%seo.meta.class%">
                <tag name="seo" alias="author" />
                <argument type="service" id="service_container" />
                <argument type="string">author</argument>
            </service>
            
            <service id="seo.meta.content.type" class="%seo.meta.class%">
                <tag name="seo" alias="content-type" />
                <argument type="service" id="service_container" />
                <argument type="string">content-type</argument>
            </service>
            
            <service id="seo.meta.lang" class="%seo.meta.class%">
                <tag name="seo" alias="content-language" />
                <argument type="service" id="service_container" />
                <argument type="string">content-language</argument>
            </service>
            
            <service id="seo.meta.charset" class="%seo.meta.class%">
                <tag name="seo" alias="charset" />
                <argument type="service" id="service_container" />
                <argument type="string">charset</argument>
            </service>
            
            <service id="seo.meta.title" class="%seo.meta.class%">
                <tag name="seo" alias="title" />
                <argument type="service" id="service_container" />
                <argument type="string">title</argument>
            </service>
        </services>
    </container>

Name it like you want (seo.xml in our example) and load it in the configLoad method of DependencyInjection/YourExtension.php file.

       	$loader = new XMLFileloader($container,__DIR__ . '/../Resources/config');

        $loader->load('seo.xml');
