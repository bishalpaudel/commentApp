## TMBC Comment App

A simple nested comment application built with Laravel 5.4 and AngularJS 1.6.

###Backend:
- Controller: App\Http\Controllers\Controller [Folder: app/Http/Controllers]
- Model: App\Comment [Folder: app]
- Comment Seeder Factory: [Folder: database/factories/ModelFactory.php]
- Comment Database Schema Definition and Versioning: [Folder: database/migrations/]
- Comment Seeder Class: [Folder: database/seeds/CommentsTableSeeder.php]
- Views:
    - Layout file: frontend.blade.php [Folder: resources/views/layouts]
    - Comment App View: index.blade.php [Folder: resources/views/comment]
- Routes:
    - API (for AJAX post and Delete comments): api.php [Folder: routes]
    - Home View Route: web.php [Folder: routes] 
- Settings: .env
    - DB_DATABASE
    - DB_USERNAME
    - DB_PASSWORD
    - MAX_COMMENT_DEPTH [to define maximum level of comments allowed]
- Tests:
    - Integration: [Folder: tests/Feature]
        - CommentControllerTest
    - Unit: [Folder: tests/unit]
        - CommentControllerTest

###Frontend:
- Libraries: 
    - AngularJS 1.6.1
    - Angular Animate 1.6.1
    - Bootstrap UI
- Controller: CommentController.js [Folder: public/js/commentApp/controllers]
- Service: CommentService.js [Folder: public/js/commentApp/services]
- App Module: App.js [Folder: public/js/commentApp]

## Requirements:
    - PHP7
    - Laravel5.4 and its dependencies
    - AngularJS, AngularAnimate, BootstrapUI

##Installation:
    - Clone this repository and run into bash: 
        php composer.phar update
    - Set correct settings (based on your environment) on .env file
    - Add to .env file: MAX_COMMENT_DEPTH=3
    - Create databse: 
        php artisan migrate
    - Seed database with initial data:
        php artisan db:seed
    - Run PHP7 Server:
        php artisan serve
        Then use provided url to access the application in the browser.

## TODO:
- Angular View should use Directives for dynamic nesting of comments. I tried this, but came up with few issues, and rolled back to manual levels (hard layering with CommentLayer1, CommentLayer2 and CommentLayer3).
- Respond with nice messages on JSON response, and implement that sensibly on frontend.
- Create Customs Exceptions and Catch those within Code.
- Cover Unit and Integration tests on AngularJS for frontend.
- Cover remaining Unit and Integration tests for Controller and Model.
- Use Closure table for storing Comment hierarchy.
- Use Localized messages (for multilingual implementation).
- Use Bower/npm and requirejs for javascript dependency management.
- Use service layer between controller and model. Most of the business logic must reside in service layer.
- Use OAuth or similar libraries for API authentication.
- Use efficient query for getting nested comments. This application can get any level of nested comments, but is not efficient.

## License

The TMBC comment application is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
