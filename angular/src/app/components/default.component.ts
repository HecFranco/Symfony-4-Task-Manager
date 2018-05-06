import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-default',
  templateUrl: '../views/default.component.html',
})
export class DefaultComponent implements OnInit {
  public title: string;

  constructor(
  ) {
    this.title = 'Default Component';
  }

  ngOnInit() {
    console.log('The default.component has been loaded!!!');
  }
}
