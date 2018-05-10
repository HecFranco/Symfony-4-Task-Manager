import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TaskDetailComponent } from '../components/task.detail.component';

describe('Task.DetailComponent', () => {
  let component: Task.DetailComponent;
  let fixture: ComponentFixture<Task.DetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ Task.DetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(Task.DetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
