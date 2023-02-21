# Enterprise Resource Planning - G1

## Project Description

A lot of companies tend to grow quickly without having the proper infrastructure to do so. To make up for that, they go for several third party applications that they have no control over and have to use several of or, and its becoming very common, they make their own all inclusive software to manage all their business needs in one centralized application.

## Expected Solution Description

An ERP system is required. For the sake of simplicity we will only be handling a small part of the HR process now as an admin. An admin can't sign up, but is added by one of the existing admins.

Every admin should be able to track several aspects of the HR process.
He/She should be able to:
1. Create and manage employees and their profiles (Web App).
2. Create and manage admins (Web App)
3. Create and manage teams. (Web App)
4. Create and manage projects. (Web App)
5. Assign employees to teams. (Web App)
6. Assign teams to projects. (Web App)
7. Create KPIs for every employee. (Web App)
8. Evaluate employee KPIs. (Web and Mobile App)
9. Generate Reports (Web and Mobile Apps)

## Employees
- Every employee must have a profile.
- An admin can go over a list of employees that can be filtered by team and project and select any employee profile to be viewed and edited.
- An employee should have a unique id that must be automatically generated, first name, last name, email, phone number, picture. Any thing else you like to add would be fine.
- An employee must be assigned to only one team.
- Employees can't sign in. Only admins can.

## Teams and Projects
- A team can have several projects.
- Every employee must have a role in the project (chosen from a predefined list)
- Several teams can work on the same project.

## KPIs
- Think of the KPIs as skills and milestones the employee must learn and improve in for the sake of getting promotions and staying in the company.
- Every employee may have several KPIs.
- Several employees may have a KPI with the same name, however this KPI must be unique. Example: if employee X has KPI "Project Management", it is not the same as employee Y's "Project Management" KPI. They should have separate entries.
- Every employee must have a certain evaluation for every KPI. You can choose the type of evaluation yourself. It can be 1 to 10, or A,B,C... or whatever you want. Make sure you state what the evaluation system you choose is.
- The admin must be able to evaluate the KPIs of each employee from the mobile app as well as the web.
- You must keep track of every KPI change along with its date. (You must not lose the old data).


## Reports
- Through the mobile app, the admin can generate employee reports.
- There are three kinds of reports:
  1. Employee project report: Shows all the projects the employee took part in and their role in it.
  2. Employee KPI reports:
    - Overall KPI list with current values.
    - Individual KPI change over time with graph.

<hr>

## Rules and Restrictions
- You can't delete a project while it has teams related to it.
- You can't delete a team while it has employees assigned to it.
- Employees can only be assigned to one team but team can be assigned to several projects.
- All the business rules and requirements are very important and should be amended (unless otherwise stated or communicated).
- There are no restrictions on the user interface and design, it just needs to be user friendly and intuitive.
- The candidate should not be using packages or libraries that achieves / solves a key requirement of the solution (Like managing KPIs).

<hr>

## Evaluation Criteria
The evaluation criteria are divided into 2 main parts:
1. Overall project completion :
  - All the business rules and requirements should be achieved and met.
  - The solution should have the functional work flow as described in the expected solution.
  - The solution should be working properly and provided the expected results.
2. The code is to be examined to check for the good programming practices, including but not limited to :
  - Performance optimization,
  - Secure coding,
  - OOP (Object-oriented programming).
  - Re-usability and maintainability.




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
