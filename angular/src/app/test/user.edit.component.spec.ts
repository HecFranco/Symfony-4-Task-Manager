import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UserEditComponent } from '../components/user.edit.component';

describe('User.EditComponent', () => {
  let component: User.EditComponent;
  let fixture: ComponentFixture<User.EditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ User.EditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(User.EditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
