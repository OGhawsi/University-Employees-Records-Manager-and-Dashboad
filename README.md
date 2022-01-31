## About the University Employees Record Manager 

This application is built with Laravel, Vue JS, Inertia JS, and Tailwind CSS  to help the administrative staff of the university to find/filter employees' records quickly based on different parameters. Here are some screenshots of the App.  
<img src="https://github.com/OGhawsi/University-Employees-Records-Finder/blob/master/public/screenshots/%20(1).png" alt="screenshot" width="400"/>
<img src="https://github.com/OGhawsi/University-Employees-Records-Finder/blob/master/public/screenshots/%20(2).png" alt="screenshot" width="400"/>



## Motivation for building this app

Kandahar University, located in Kandahar, Afghanistan, had employees data stored across multiple spreadsheets.   As the university has no budget to spend on app like this, they asked me to help them with their data problem and make a central app for which should enable them to find the records instantly, based on different parameters.

So I took this opportunity to show case my web development skills through building something that can actually help someone.

## What isn't it? 

This is not a traditional employee management system. This app does not have attendance, classes, subjects or any other sections, that you might expect in an employee management system. 

## What is it?

This app helps provide employees data through the report section through an easy to use interface. 

This app has the following sections: 

- Dashboard
- Employee
    - Basic Information
    - Education/Degree Details (Bachelor, Masters, Ph.D.)
    - Academic Ranks (Assistant Prof. Associate Prof. Professor, etc.)
    - Address Info
    - Profile
    - Attachment/Documents
- Reports  ( Filtering records based on different parameters )
- Faculties
- Departments
- University (which is the name of the app)
- Settings

All of the above, are just different CRUD operations connected with each other logically.

The requirements were collected from the Kandahar University only, but this app can be directly usable by all the universities across Afghanistan, because, all of these universities have the same administrative structure and work under the ministry of higher educations of Afghanistan.

## Usage & Instalation 
- Clone the repository with `git clone`
- Copy `.env.example` file to `.env` and edit database credentials there
- Run `composer install`
- Run php artisan `key:generate`
- Run `npm install & npm run dev`
- Run `php artisan migrate --seed` the seeding might take a bit. 
- That's it, use these creditionals to login and see the app from inside
    - Username: `admin@example.com`
    - Password: `password`

### Future Enhancements

- Adding tests cases
- Adding roles and permisions
- Adding internationalization support
- Enhancing the UI
- Add vue teleport

## Financial Support
Help the free education sector in Afghanistan through supporting 
the developer of this app financially with buying me a [coffee](https://www.buymeacoffee.com/ghawsi) ☕. 
Thank You. 

## License
The Laravel framework and this app are open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
