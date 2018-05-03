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
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
  ) {
    this.title = 'Identify yourself';
    this.user = {
      'email': '',
      'password': '',
      'getHash': 'true',
    }
  }

  ngOnInit() {
    console.log('The login.component has been loaded!!!');
    console.log(JSON.parse(localStorage.getItem('identity')));
    console.log(JSON.parse(localStorage.getItem('token')));
  }
  onSubmit(){
    console.log(this.user);
    this._userService.signup(this.user).subscribe(
      response => {
        this.identity = response;
        if(this.identity.length <= 1){
          console.log('Server Error');
        }{
          if(!this.identity.status){
            localStorage.setItem('identity', JSON.stringify(this.identity));
            // GET TOKEN
            this.user.getHash = null;
            this._userService.signup(this.user).subscribe(
              response => {
                this.token = response;
                if(this.identity.length <= 1){
                  console.log('Server Error');
                }{
                  if(!this.identity.status){
                    localStorage.setItem('token', JSON.stringify(this.token));
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
}
