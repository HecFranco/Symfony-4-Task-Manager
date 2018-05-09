import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params, RouterEvent } from '@angular/router';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-login',
  templateUrl: '../views/login.component.html',
  providers: [UserService]
})
export class LoginComponent implements OnInit {
  public title: string;
  public user;
  public identity;
  public token;

  constructor(
    private _userService: UserService,
    private _router: Router,
  ) {
    this.title = 'Identify yourself';
    this.user = {
      'email': '',
      'password': '',
      'getHash': 'true'
    }
  }

  ngOnInit() {
    console.log('The login.component has been loaded!!!');
    this.logout();
    this.redirectIfIdentity();
  }

  onSubmit() {
    console.log('Data sent : ', this.user);
    this._userService.signup(this.user).subscribe(
      response => {
        this.identity = response;
        console.log('Identity Response : ', response);
        if (this.identity.length <= 1) {
          console.log('Server Error');
        } else {
          if (!this.identity.status) {
            localStorage.setItem('identity', JSON.stringify(this.identity));
            // GET TOKEN
            this.user.getHash = 'null';
            this._userService.signup(this.user).subscribe(
              response => {
                this.token = response;
                console.log('Token Response : ', response);
                if (this.identity.length <= 1) {
                  console.log('Server Error');
                } {
                  if (!this.identity.status) {
                    localStorage.setItem('token', JSON.stringify(this.token));
                    window.location.href = '/';
                  }
                }
              },
              error => { console.log(<any>error); }
            );
          }
        }
      },
      error => { console.log(<any>error); }
    );
  }

  logout() {
    if (this._router.url === '/logout') {
      localStorage.removeItem('identity');
      localStorage.removeItem('token');

      this.identity = null;
      this.token = null;

      window.location.href = '/login';
    }
  }

  redirectIfIdentity() {
    let identity = this._userService.getIdentity();
    if (identity != null && identity.sub && this._router.url === '/login') {
      this._router.navigate(['/']);
    }
  }
}
