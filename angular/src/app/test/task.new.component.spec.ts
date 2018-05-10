import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TaskNewComponent } from '../components/task.new.component';

describe('Task.NewComponent', () => {
  let component: Task.NewComponent;
  let fixture: ComponentFixture<Task.NewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ Task.NewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(Task.NewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
