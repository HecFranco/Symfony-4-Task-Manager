import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TaskEditComponent } from '../components/task.edit.component';

describe('Task.EditComponent', () => {
  let component: Task.EditComponent;
  let fixture: ComponentFixture<Task.EditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ Task.EditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(Task.EditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
