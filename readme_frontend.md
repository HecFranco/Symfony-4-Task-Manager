# Angular 5 - Task Manager (Frontend)

We will make the frontend of the application with the framework Angular and Bootstrap.

### Phases of the Demo
1. []()


---------------------------------------------------------------------------------------

* We will create the project through the console command: `ng new angular --style scss --routing`

---------------------------------------------------------------------------------------

### Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* 

### Summary Console command`s to be used

* `ng serve`
* `ng generate module`
* `ng help generate component`
* `ng help generate component --dry-run`
* `ng g component mydir\dir2\UserProfile --dry-run`
* `ng g component UserProfile`
* `ng new app0 --style-scss --dry-run`

# Symfony 4 - Task Manager (Backend)

--------------------------------------------------------------------------------------------

### 1.Project Creation

--------------------------------------------------------------------------------------------

1. Created our project using the Console command's, 

```bash
ng new angular --style scss --routing
```

2. In the next step we will access the project folder using:

```bash
cd angular
```

3. It is necessary to install **npm** to run **angular project**:

```bash
npm install
```

4. Now, you will be able to view the result of demo when write in the terminal the command console `npm start` or `:

```bash
ng serve
```

5. Access to [http://localhost:4200/](http://localhost:4200/) to view the result.

--------------------------------------------------------------------------------------------

### 2.Install Bootstrap

--------------------------------------------------------------------------------------------

(Source: [https://www.marathonus.com/about/blog/kickstarting-an-angular-5-project-with-bootstrap-4-sass-and-font-awesome/](https://www.marathonus.com/about/blog/kickstarting-an-angular-5-project-with-bootstrap-4-sass-and-font-awesome/))

1. To install Bootstrap in our Angular's project we will used the command `npm install bootstrap`.

```bash
npm install bootstrap
```

2. We will also install **Font-awesome**, **jquery** and **tether**.

```bash
npm install font-awesome jquery tether
```

3. We must configure [.angular-cli.json](.angular-cli.json) to use bootstrap.

```diff
//...
  "apps": [
    {
      "root": "src",
      "outDir": "dist",
      "assets": [
        "assets",
        "favicon.ico"
      ],
      "index": "index.html",
      "main": "main.ts",
      "polyfills": "polyfills.ts",
      "test": "test.ts",
      "tsconfig": "tsconfig.app.json",
      "testTsconfig": "tsconfig.spec.json",
      "prefix": "app",
      "styles": [
--      "styles.scss"
++      "styles.scss",
++      "../node_modules/bootstrap/dist/scss/bootstrap.scss"
++      "../node_modules/font-awesome/scss/font-awesome.scss"
      ],
--    "scripts": [],
++    "scripts": [  
++      "../node_modules/jquery/dist/jquery.js",
++      "../node_modules/tether/dist/js/tether.js",
++      "../node_modules/bootstrap/dist/js/bootstrap.js"
++    ],
      "environmentSource": "environments/environment.ts",
      "environments": {
        "dev": "environments/environment.ts",
        "prod": "environments/environment.prod.ts"
      }      
//...
```

> Another option is to import the library within [src/styles.scss](./src/styles.scss).

_[src/styles.scss](./src/styles.scss)_
```diff
/* You can add global styles to this file, and also import other style files */
++ @import "../node_modules/bootstrap/scss/bootstrap";
++ $fa-font-path: "~font-awesome/fonts";
++ @import "~font-awesome/scss/font-awesome";
```

4. Now, you will be able to view the result of demo when write in the terminal the command console `npm start` or `:

```bash
ng serve
```

5. Access to [http://localhost:4200/](http://localhost:4200/) to view the result.

--------------------------------------------------------------------------------------------

### 3.Install Angular Material and Angular Animations

--------------------------------------------------------------------------------------------

(Source: [https://material.angular.io/guide/getting-started](https://material.angular.io/guide/getting-started))

1. To install Bootstrap in our Angular's project we will used the command `npm install --save @angular/material @angular/cdk `.

```bash
npm install --save @angular/material @angular/cdk 
```

> Some Material components depend on the Angular animations module in order to be able to do more advanced transitions. If you want these animations to work in your app, you have to install the `@angular/animations` module and include the `BrowserAnimationsModule` in your app.

```bash
npm install --save @angular/animations
```

2. Now, you will be able to view the result of demo when write in the terminal the command console `npm start` or `:

```bash
ng serve
```

3. Access to [http://localhost:4200/](http://localhost:4200/) to view the result.

--------------------------------------------------------------------------------------------

### 4.First Steps

--------------------------------------------------------------------------------------------

1. We will cleaned the **app.module** template [/src/app/app.component.html](./src/app/app.component.html)

_[/src/app/app.component.html](./src/app/app.component.html)_
```diff
<!--The content below is only a placeholder and can be replaced.-->
-- <div style="text-align:center">
   <h1>
    Welcome to {{ title }}!
   </h1>
--  <img width="300" alt="Angular Logo" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNTAgMjUwIj4KICAgIDxwYXRoIGZpbGw9IiNERDAwMzEiIGQ9Ik0xMjUgMzBMMzEuOSA2My4ybDE0LjIgMTIzLjFMMTI1IDIzMGw3OC45LTQzLjcgMTQuMi0xMjMuMXoiIC8+CiAgICA8cGF0aCBmaWxsPSIjQzMwMDJGIiBkPSJNMTI1IDMwdjIyLjItLjFWMjMwbDc4LjktNDMuNyAxNC4yLTEyMy4xTDEyNSAzMHoiIC8+CiAgICA8cGF0aCAgZmlsbD0iI0ZGRkZGRiIgZD0iTTEyNSA1Mi4xTDY2LjggMTgyLjZoMjEuN2wxMS43LTI5LjJoNDkuNGwxMS43IDI5LjJIMTgzTDEyNSA1Mi4xem0xNyA4My4zaC0zNGwxNy00MC45IDE3IDQwLjl6IiAvPgogIDwvc3ZnPg==">
-- </div>
-- <h2>Here are some links to help you start: </h2>
-- <ul>
--  <li>
--    <h2><a target="_blank" rel="noopener" href="https://angular.io/tutorial">Tour of Heroes</a></h2>
--  </li>
--  <li>
--    <h2><a target="_blank" rel="noopener" href="https://github.com/angular/angular-cli/wiki">CLI Documentation</a></h2>
--  </li>
--  <li>
--    <h2><a target="_blank" rel="noopener" href="https://blog.angular.io/">Angular blog</a></h2>
--  </li>
-- </ul>
```

2. In this project we will need to use the **angular form and http components**, for this we import them into [/src/app/app.module.ts](./src/app/app.module.ts).

_[/src/app/app.module.ts](./src/app/app.module.ts)_
```diff
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
++ import { FormsModule } from '@angular/forms';
++ import { HttpModule } from '@angular/http';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';

@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule,
--  AppRoutingModule
++  AppRoutingModule,
++  FormsModule,
++  HttpModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
```

> Our project will be structured in `components`, `models`, `views` and `test`, so we must create a folder for each type of element within the [src/](./src/) folder.

´´´bash
/src/
 |- /app/
      |- /components/
      |- /models/
      |- /views/
      |- /test/
´´´

3. We will generated our first component using the command `ng generate component login --style scss`.

```bash
  create src/app/login/login.component.html (24 bytes)
  create src/app/login/login.component.spec.ts (621 bytes)
  create src/app/login/login.component.ts (266 bytes)
  create src/app/login/login.component.scss (0 bytes)
  update src/app/app.module.ts (596 bytes)
```

> This command will have generated a folder with the content of the new component within the app called login. As we mentioned before, we will have to redistribute that content and reference it in the different files to follow the logical structure of the previously defined project.

* [/src/app/login/login.component.html](./src/app/login/login.component.html) ->
[/src/app/views/login.component.html](./src/app/views/login.component.html).
* [/src/app/login/login.component.ts](./src/app/login/login.component.ts) ->
[/src/app/components/login.component.ts](./src/app/components/login.component.ts).
* [/src/app/login/login.component.scss](./src/app/login/login.component.scss) -> it's erased.
* [/src/app/login/login.component.spec.ts](./src/app/login/login.component.spec.ts) -> it's erased.

4. We update [/src/app/app.module.ts](./src/app/app.module.ts) with the new component locations.

_[/src/app/app.module.ts](./src/app/app.module.ts)_
```diff
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
-- import { LoginComponent } from './login/login.component';
++ import { LoginComponent } from './components/login.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
```

> **Note:** Don't forget to declare the new component inside the decorator `@ ngmodule` in `declarations: [...]`.

5. In the next step we will modify [/src/app/components/login.component.ts](./src/app/components/login.component.ts). _We will also include the methods that will manage the routing (`import { Router, ActivatedRoute, Params, RouterEvent } from '@angular/router';`)._

_[/src/app/components/login.component.ts](./src/app/components/login.component.ts)_
```diff
import { Component, OnInit } from '@angular/core';
++ import { Router, ActivatedRoute, Params, RouterEvent } from '@angular/router';

@Component({
  selector: 'app-login',
-- templateUrl: './login.component.html',
++ templateUrl: '../views/login.component.html' 
-- styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
++ public title: string;

-- constructor() { }
++ constructor(
++  private _route: ActivatedRoute,
++  private _router: Router
++ ){
++  this.title = 'Login Component';
++ }

  ngOnInit() {
++ console.log('The login.component has been loaded!!!');    
  }

}
```

> We repeat the same process to create a **component register**, `ng generate component register --style scss`.

```bash
  create src/app/register/register.component.html (27 bytes)
  create src/app/register/register.component.spec.ts (642 bytes)
  create src/app/register/register.component.ts (278 bytes)
  create src/app/register/register.component.scss (0 bytes)
  update src/app/app.module.ts (691 bytes)
```

> This command will have generated a folder with the content of the new component within the app called login. As we mentioned before, we will have to redistribute that content and reference it in the different files to follow the logical structure of the previously defined project.

* [/src/app/register/register.component.html](./src/app/register/register.component.html) ->
[/src/app/views/register.component.html](./src/app/views/register.component.html).
* [/src/app/register/register.component.ts](./src/app/register/register.component.ts) ->
[/src/app/components/register.component.ts](./src/app/components/register.component.ts).
* [/src/app/register/register.component.scss](./src/app/register/register.component.scss) -> it's erased.
* [/src/app/register/register.component.spec.ts](./src/app/register/register.component.spec.ts) -> it's erased.


6. We update [/src/app/app.module.ts](./src/app/app.module.ts) with the new component locations.

_[/src/app/app.module.ts](./src/app/app.module.ts)_
```diff
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
import { LoginComponent } from './components/login.component';
-- import { RegisterComponent } from './register/register.component';
++ import { RegisterComponent } from './components/register.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent
    RegisterComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
```

> **Note:** Don't forget to declare the new component inside the decorator `@ ngmodule` in `declarations: [...]`.

7. In the next step we will modify [/src/app/components/register.component.ts](./src/app/components/register.component.ts). _We will also include the methods that will manage the routing (`import { Router, ActivatedRoute, Params, RouterEvent } from '@angular/router';`)._

_[/src/app/components/login.component.ts](./src/app/components/login.component.ts)_
```diff
import { Component, OnInit } from '@angular/core';
++ import { Router, ActivatedRoute, Params, RouterEvent } from '@angular/router';

@Component({
  selector: 'app-register',
-- templateUrl: './register.component.html',
++ templateUrl: '../views/register.component.html' 
-- styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {
++ public title: string;

-- constructor() { }
++ constructor(
++  private _route: ActivatedRoute,
++  private _router: Router
++ ){
++  this.title = 'Register Component';
++ }

  ngOnInit() {
++ console.log('The register.component has been loaded!!!');    
  }

}
```

8. Now we can include the component within the module [/src/app/app.component.html](./src/app/app.component.html).

_[/src/app/app.component.html](./src/app/app.component.html)_
```diff
<!--The content below is only a placeholder and can be replaced.-->
<h1>Welcome to {{ title }}!</h1>
++ <app-login></app-login>
++ <app-register></app-register>
```

9. Now, you will be able to view the result of demo when write in the terminal the command console `npm start` or `:

```bash
ng serve
```

10. Access to [http://localhost:4200/](http://localhost:4200/) to view the result.


--------------------------------------------------------------------------------------------

### 5.Router

--------------------------------------------------------------------------------------------


1. To define a new route in our application, we will modify [/src/app/app-routing.module.ts](./src/app/app-routing.module.ts)

_[/src/app/app-routing.module.ts](./src/app/app-routing.module.ts)_
```diff
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

++ import { LoginComponent } from './components/login.component';
++ import { RegisterComponent } from './components/register.component';

-- const routes: Routes = [];
++ const routes: Routes = [
++   {path: '', component: LoginComponent},
++   {path: 'login', component: LoginComponent},
++   {path: 'register', component: RegisterComponent},
++   {path: '**', component: LoginComponent}
++ ];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
```

2. And we add the routing of **Angular** `import { RouterModule } from '@angular/router';` in [/src/app/app.module.ts](./src/app/app.module.ts).

_[/src/app/app.module.ts](./src/app/app.module.ts)_
```diff
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

import { AppRoutingModule } from './app-routing.module';
++ import { RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { LoginComponent } from './components/login.component';
import { RegisterComponent } from './components/register.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
```

3. Now, we modify [/src/app/app.component.html](./src/app/app.component.html) to add the component `<router-outlet></router-outlet>` that will show the component according to its route, [/src/app/app-routing.module.ts](./src/app/app-routing.module.ts).

_[/src/app/app.component.html](./src/app/app.component.html)_
```diff
<!--The content below is only a placeholder and can be replaced.-->
<h1>Welcome to {{ title }}!</h1>
-- <app-login></app-login>
-- <app-register></app-register>
++ <router-outlet></router-outlet>
```

9. Now, you will be able to view the result of demo when write in the terminal the command console `npm start` or `:

```bash
ng serve
```

10. Access to [http://localhost:4200/](http://localhost:4200/) to view the result.

--------------------------------------------------------------------------------------------

### 5.Layout Menu

--------------------------------------------------------------------------------------------

_[/src/app/app.component.html](./src/app/app.component.html)_
```diff
++ <header id="header">
++  <div class="navbar navbar-default">
++    <div class="navbar-header">
++      <button type="button" class="navbar-toggle collapsed" data-togle="collapse" data-target="#bs-example-navbar-collapse-1" aria-extended="false">
++        <span class="sr-only">Toggle</span>
++        <span class="icon--bar"></span>
++        <span class="icon--bar"></span>
++        <span class="icon--bar"></span>
++      </button>
++      <!--logo-->
++      <a class="navbar-brand" [routerLink]="['/']"
++        Personal Task
++      </a>
++    </div>
++  </div>
++ </header>
-- <!--The content below is only a placeholder and can be replaced.-->
-- <h1>Welcome to {{ title }}!</h1>
<router-outlet></router-outlet>
```