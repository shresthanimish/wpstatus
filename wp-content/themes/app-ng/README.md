# WPNG2

A minimal WordPress theme that runs off of an Angular 2 app. Built for the tutorial http://doppiaeast.com/article/angular-2-wordpress-theme-setup/.

## Usage

First, run `npm install`.

Inside of src/app/posts, open posts.service.ts. On the line where it says `private postsUrl = "http://{YOUR_SITE_HERE}.com/wp-json/wp/v2/";`, just place in your site name.

For development, simply run `ng serve`, in the terminal inside the project folder, and the CLI will do the rest. The content of the site is managed from the WordPress admin panel.  

To push the project to the server, run `ng build --prod --deploy-url="/wp-content/themes/app-ng/dist/"` from your command line. This will output a `dist` folder. Upload index.php, styles.css, functions.php, and the dist folder to your theme directory on your server. You should be good to go!

This project will play nice with the Angular CLI.

## Contributions

Pull requests always welcome