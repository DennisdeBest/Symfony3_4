Symfony 3.4 base project
=======

# Bundles
## Vendor Bundles

This base project relies on quite a few different bundles but the main attractions here are the Sylius Bundle integrations.
These bundles are :
- SyliusResourceBundle: used to configure every "resource", any object model that is stored in the database and can be acted upon (CRUD).
- SyliusGridBundle: Creates the necessary routing and views for any object CRUD
- SyliusUiBundle: Works with the grid bundle to render the views.
- SyliusFixturesBundle: Used to generate fixtures for the project.

We'll get more into detail on how these bundles are used and configured later on.
Other noticeable bundles are:
- DavidBaduraFakerBundle: Used to generate data for the fixtures.
- PUGXMultiUserBundle: Used to manage multiple users from a base user class with the fosUserProvider.
- WhiteOctoberPagerfantaBundle: Generates pagination, sylius grid relies on this bundle.
- SonataBlockBundle: Render blocks in twig templates, used for the Sylius Grids.
- IvoryGoogleMapBundle: Google Maps API integration
- IvorySerializerBundle: Serialize google maps data
- IvoryCKEditorBundle: Create wysiwyg text fields
- HttplugBundle: Symfont Httplug integration used by Google Maps bundle
- winzouStateMachineBundle: Define transitions and callbacks for states.
- FOSJsRoutingBundle: expose routes to JS for easy ajax calls
- FOSRestBundle: Generate RSTful API's
- FOSUserBundle: Handle user generation, authentication and permissions
- StofDoctrineExtensionsBundle: Allow for annotations like timestampable for doctrine entities.
- JMSTranslationBundle: Extract translations in multiple formats

## Our Bundles

In order to use this as a basis to quickly generate new Symfony projects there are a couple of basic bundles we created.

### CoreBundle

This Bundle contains the entities and listeners that will be used all throughout the project.
#### Entities
- AddressTrait : Adds the address and place_id fields and the relative getters and setters aswell as the validation methods.
- TimeStampableInterface/Trait: Uses doctrine extension annotations to include timestamps on creation and on update of entities.
- ToggleableInterface/Trait: Generate an enabled field and relative functions for an entity.
- UuidInterface/Trait: Generate a uuid for an entity

#### Listeners
- JwtListener : Handle JWT authentication
- UuidListener: On Prepersist of an entity checks wether it has the setUuid method and sets it accordingly.

#### FormTypes
- AddressType: Use the IvoryGoogleMapBundle to provide an autocompleted field for an address from the google maps API.
Adds a JS event to fill the place_id field depending on the selected address.
This FormType needs the parent forms name to be able to bind the JS event as well as the data_class for the error_mapping.
``` c++
->add('address', AddressType::class, [
                'label' => 'rc.form.customer.address',
                'data_class' => Customer::class,
                'form_name' => $this->getName()
            ]);
```

### UserBundle

This is the base user that can be extended to create different types of users.
The User Entity contains the annotations used to join the tables of the base user and the custom user :
``` c++
 * @ORM\InheritanceType("JOINED")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *    "customer" = "RC\CustomerBundle\Entity\Customer"
 *     })
```

Foreach new entity based on this user you need to add a line to the DiscriminatorMap with it's name and associated class.

This will created foreign key constraints between the base class and the custom classes which makes it hard to correctly purge the database
when running the fixtures. That's why the class also contains a FixtureListener to which you need to pass the repositories of each user class.
```c++
//$contactRepo = $this->container->get('rc.repository.contact');
//$customerRepo = $this->container->get('rc.repository.customer');
$userRepo = $this->entityManager->getRepository('RCUserBundle:User');

//$repos = [$contactRepo, $customerRepo, $userRepo];
$repos = [$userRepo];
```

Be careful to put the userRepo last.

### WebBundle

This bundle contains all the views and routing for the application.


#### Routing
The routing is organized as follows :
- Resources/config/Routing/
    - main.yml: contains the route to the homepage and includes the other routing files, this is the file included in the main routing.yml config file
    - [folder]/: The folder name corresponds to different sections of the application (app, frontend, backend ...)
        - main.yml: Includes every other file in the folder, this file is included in the parent main.yml
        - [entityName].yml: The routing for any entity that belongs to this section of the application.

The routing for an entity will normaly be a Sylius resource :
```yml
rc_customer:
    resource: |
        alias: rc.customer
        identifier: uuid
        section: app
        redirect: index
        templates: RCWebBundle:Crud
        except: []
        grid: rc_customer
        criteria:
            uuid: $uuid
        vars:
            all:
                subheader: rc.grid.customer # define a translation key for your entity subheader
            index:
                icon: 'file image outline' # choose an icon that will be displayed next to the subheader
    type: sylius.resource

```

We'll most likely be using uuids instead of normal id's to avoid people trying to enumerate the resource.
In order to make that possible we need to set the identifier: uuid and add it to the criteria.
Redirect indicates which route to redirect to after a resource is created.
The grid option has to be set to the particular grid for that entity. //TODO add link
The Templates option takes a Directory as argument. this directory has to contain the templates create.html.twig, show.html.twig, and update.html.twig

#### Views

A couple of default views have been added to the project already:
- Crud/: Contains the views used to render the cruds
    - Create/ || Index/ || Show/ || Update/ : Contain al the parts used by the main templates
    - create || index || show || update .html.twig: main templates for the crud that include the parts in the directory of the same name.
- Macro/breadcrumb.html.twig: Generates breadcrumbs used by the Crud templates.
- layout.html.twig: basic layout for the application
- page.html.twig: contains the headers, html tags, meta tags etc ...

### Customer Bundle

As an example of how to implement new user bundles a CustomerBundle is included
This bundle revolves around the Customer Entity.
We can specify which fields of the base user class need to be unique with doctrine annotations :
```c++
 * @UniqueEntity(fields="username", targetClass="RC\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "RC\UserBundle\Entity\User", message="fos_user.email.already_used")
```
The class also implements multiple interfaces and uses some traits
```c++
class Customer extends BaseUser implements ResourceInterface, TimestampableInterface, UuidInterface, ToggleableInterface
{
    use TimestampableTrait, UuidTrait, AddressTrait, ToggleableTrait;
```

Any class that will be used with Sylius Grid needs a FormType.
For this Bundle this will be Form/Type/RegistrationType.php.

There is also an EventSubscriber that will generate a password for the customer upon registration and send it to him by email.

Thanks to Symfony's autoregistration and autowireing of services there is no need to register anything in the service.yml file.

# Configuration

Some of these bundles need to be configured to work correctly, this is the default configuration for those bundles :
``` yml
stof_doctrine_extensions:
    default_locale: en_US
    orm:
        default:
            softdeleteable: true
            loggable: true
            timestampable: true
# Swiftmailer Configuration
swiftmailer:
    transport: '%mailer_transport%'
    host: '%mailer_host%'
    username: '%mailer_user%'
    password: '%mailer_password%'
    spool: { type: memory }

fos_user:
    db_driver: orm
    firewall_name: main
    user_class: RC\Bundle\UserBundle\Entity\User
    from_email:
        address: '%mailer.from_address%'
        sender_name: '%mailer.from_name%'
    service:
        user_manager: pugx_user_manager

httplug:
    classes:
        client: Http\Adapter\Guzzle6\Client
        message_factory: Http\Message\MessageFactory\GuzzleMessageFactory
    clients:
        acme:
            factory: httplug.factory.guzzle6

ivory_google_map:
    geocoder:
        client: httplug.client.default
        message_factory: httplug.message_factory.default
        format: json
        api_key: ~
    place_autocomplete:
        client: httplug.client.default
        message_factory: httplug.message_factory.default
        api_key: ~

david_badura_faker:
    locale: fr_FR

sylius_fixtures:
    suites:
        default:
            listeners:
                purge_user_tables: ~
            fixtures:
                customer:
                    priority: 100
                contact:
                    priority: 90


sonata_block:
    default_contexts: [sonata_page_bundle]
    blocks:
        sonata.admin.block.admin_list:
            contexts:   [admin]

        #sonata.admin_doctrine_orm.block.audit:
        #    contexts:   [admin]

        sonata.block.service.text:
        sonata.block.service.rss:

```

The configuration file also includes some other files :

```yml
imports:
    - { resource: parameters.yml }
    - { resource: security.yml }
    - { resource: services.yml }
    - { resource: resources.yml }
    - { resource: fixtures.yml }
    - { resource: grids/grids.yml }
```

We'll go a bit more into detail for some of these.

## Grids

The directory app/config/grids is structured as follows:
- grids.yml: includes all the other grids files
- [appSection]/: directory that contains all the grids relevant to the section of the application it represents (app, frontend, backend ...).
    - [entityName].yml: contains the resource grid configuration

Take a look at the grids.yml file :
```yml
imports:
    - { resource: app/customer.yml }

sylius_grid:
    templates:
        action:
            default: "@SyliusUi/Grid/Action/default.html.twig"
            create: "@SyliusUi/Grid/Action/create.html.twig"
            delete: "@SyliusUi/Grid/Action/delete.html.twig"
            show: "@SyliusUi/Grid/Action/show.html.twig"
            update: "@SyliusUi/Grid/Action/update.html.twig"
            apply_transition: "@SyliusUi/Grid/Action/applyTransition.html.twig"
            links: "@SyliusUi/Grid/Action/links.html.twig"
            archive: "@SyliusUi/Grid/Action/archive.html.twig"

        filter:
            string: "@SyliusUi/Grid/Filter/string.html.twig"
            boolean: "@SyliusUi/Grid/Filter/boolean.html.twig"
            date: "@SyliusUi/Grid/Filter/date.html.twig"
            entity: "@SyliusUi/Grid/Filter/entity.html.twig"
            money: "@SyliusUi/Grid/Filter/money.html.twig"
            exists: "@SyliusUi/Grid/Filter/exists.html.twig"
```
Here we import all the other grid files and set templates for the filters and actions.
Some of those templates can be found in the app/Resources/SyliusUiBundle directory, some twig functions do not work out of the box with the bundle so we had to overwrite them.

Now an example of a grid file:
```yml
sylius_grid:
    grids:
        rc_customer:
            driver:
                name: doctrine/orm
                options:
                    class: RC\CustomerBundle\Entity\Customer
            fields:
                firstname:
                    type: string
                    label: rc.grid.customer.firstname
                lastname:
                    type: string
                    label: rc.grid.customer.lastname
                enabled:
                    type: twig
                    label: sylius.ui.enabled
                    options:
                        template: SyliusUiBundle:Grid/Field:enabled.html.twig
            actions:
                main:
                    create:
                        type: create
                item:
                    update:
                        type: update
                        options:
                            link:
                                parameters:
                                    uuid: resource.uuid
                    delete:
                        type: delete
                        options:
                            link:
                                parameters:
                                    uuid: resource.uuid
                    show:
                        type: show
                        options:
                            link:
                                parameters:
                                    uuid: resource.uuid
```

Here we have the grid for our CustomerBundle, the fields section contains the fields to be shown in the list view.
The actions have been modified to take the uuid instead of the Id.

## Resources

Sylius resources must be declared in the configuration.
```yml
sylius_resource:
    resources:
        rc.customer:
            classes:
                model: RC\CustomerBundle\Entity\Customer
                form: RC\CustomerBundle\Form\Type\RegistrationType
```

A resource will need at least a model and a form.

## Fixtures
 ```yml
 sylius_fixtures:
     suites:
         default:
             listeners:
                 purge_user_tables: ~
             fixtures:
                 customer:
                     priority: 100
 ```
This configuration file allows us to load all the fixtures we have created, configure their options aswell as the priorities.
We can also configure listeners that will take action at a specific time in the fixture loading cycle.

These fixtures need to be loaded as services, thanks to the autoload of services there is not much to do.
The services do, however, need a certain tag in order to be recognized properly. To set this tag for all fixtures at once we use the _instanceOf option for the services :
```yml
###Set tags for all fixtures
    _instanceof:
        Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture:
            tags:
              - { name: sylius_fixtures.fixture }
        Sylius\Bundle\FixturesBundle\Listener\AbstractListener:
            tags:
              - { name: sylius_fixtures.listener }
``` 
As long as our bundle as a whole is present in the services.yml file the fixtures and listeners will be fully functional without any further configuration.
# Services

The services are autowired and autoconfigured since Symfony 3.3.
What this means is that by default every class in your bundle will be registered as a service
by default every service is private so it cannot be directly fetched from the container

```yml
services:
    # default configuration for services in *this* file
    _defaults:
        autowire: true
        autoconfigure: true
        public: false

    RC\CoreBundle\:
        resource: '../../src/RC/CoreBundle/*'

    RC\UserBundle\:
        resource: '../../src/RC/UserBundle/*'

    RC\CustomerBundle\:
        resource: '../../src/RC/CustomerBundle/*'
```

For most service all you need to do is specify the directory of the bundle.
If the constructor of your service contains TypeHints you will no longer need to add any arguments to the service registration !
Symfony is also smart enough to add most tags automatically based on what the service is an instance of.
For some listeners however, this is not enough. In those cases you can simply configure the service as usual:
```yml

    RC\CoreBundle\EventListener\UuidListener:
        tags:
          - { name: doctrine.event_listener, event: prePersist }

```

# Assets

The assets are located in the assets folder at the root of the project.
This directory contains multiple subdirectories:
- css: contains the global.scss sass file and the semantic.css file.
- fonts: contains icon font sets.
- images: all images
- js:
    - main.js: main js file used in the project
    - semantic.min.js: semantic UI js
    - semantic-binding.js: used to bind the semantic ui functions to the correct elements.

Webpack Encore is used to compile and serve the assets, here is the webpack configuration :

```js
// webpack.config.js
var Encore = require('@symfony/webpack-encore');
var CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
// directory where all compiled assets will be stored
    .setOutputPath('web/build/')

    // what's the public path to this directory (relative to your project's document root dir)
    .setPublicPath('/build')

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // will output as web/build/app.js
    .addEntry('app', './assets/js/main.js')

    // will output as web/build/global.css
    .addStyleEntry('global', './assets/css/global.scss')

    // allow sass/scss files to be processed
    .enableSassLoader()

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    .enableSourceMaps(!Encore.isProduction())

// create hashed filenames (e.g. app.abc123.css)
// .enableVersioning()
;

// export the final configuration
var config = Encore.getWebpackConfig();
config.plugins.push(new CopyWebpackPlugin(
    [
        { from: './assets/fonts', to: 'fonts'},
        { from: './assets/images', to: 'images'},
        ]));

module.exports = config;
```

The copyWebpackPlugin is used to copy the content of fonts and images as is.
To compile the assets you need to run the command
```bash
yarn run encore dev
```
Or run
```bash
yarn run encore dev --watch
```
To have webpack automatically compile your assets whenever a file changes.

Once compiled the assets can be found in the web/build directory.

You can now include these assets in the application :
```php
{% block stylesheets %}
    <link href="{{ asset('build/global.css') }}" rel="stylesheet">
{% endblock %}

{% block scripts %}
    <script src="{{ asset('build/app.js') }}"></script>
{% endblock %}

```
