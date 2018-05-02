import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params, RouterEvent } from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: '../views/register.component.html'
})
export class RegisterComponent implements OnInit {
  public title: string;

  constructor(
    private _route: ActivatedRoute,
    private _router: Router
  ){
    this.title = 'Register Component';
  }

  ngOnInit() {
    console.log('The register.component has been loaded!!!');
  }

}
