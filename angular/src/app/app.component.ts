import { Component, OnInit } from '@angular/core';
import { UserService } from './services/user.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
  providers: [UserService]
})
export class AppComponent {
  public title = 'app';
  public identity;
  public token;

  constructor(
    private _userService: UserService
  ) {
    this.identity = this._userService.getIdentity();
    this.identity = this._userService.getToken();
  }

  ngOnInit() {
    console.log('app.component loaded!!');
  }
}
