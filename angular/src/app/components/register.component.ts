import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params, RouterEvent } from '@angular/router';

import { FormBuilder, FormGroup, Validators} from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: '../views/register.component.html'
})
export class RegisterComponent implements OnInit {
  public title: string;
  public user;
  
  constructor(
    private _route: ActivatedRoute,
    private _router: Router
  ){
    this.title = 'Register Component';
    this.user = {
      'name': ['', [Validators.required]],
      'company': ['', [Validators.required, Validators.minLength(5), Validators.maxLength(10)]],
      'email': ['', [Validators.required, Validators.email]],
      'age': ['', [Validators.required]],
      'url': ['', [Validators.pattern(/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/)]],
      'password': ['', [Validators.pattern(/^[a-z0-9_-]{6,18}$/)]],
    }
  }

  ngOnInit() {
    console.log('The register.component has been loaded!!!');
  }

}
