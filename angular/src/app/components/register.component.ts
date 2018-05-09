import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params, RouterEvent } from '@angular/router';

import { User } from '../models/user';
import {UserService } from '../services/user.service';

import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: '../views/register.component.html',
  providers: [UserService] 
})
export class RegisterComponent implements OnInit {
  public title: string;
  public user: User;
  public status;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService 
  ) {
    this.title = 'Register Component';
    this.user = new User(1, 'user', '', '', '', '');
  }

  ngOnInit() {
    console.log('The register.component has been loaded!!!');
  }

  onSubmit() {
    console.log('Data Register Form recibed : ', this.user);
    this._userService.register(this.user).subscribe(
      response => {
        this.status = (response.status != 'success')? 'error' : response.status;
        if(response.status == 'success') { 
          this.user = new User(1, 'user', '', '', '', ''); 
        }
      },
      error => {
        console.log(<any>error);
      }
    )
  }

}
