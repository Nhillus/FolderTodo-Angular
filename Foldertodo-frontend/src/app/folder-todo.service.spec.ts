import { TestBed } from '@angular/core/testing';

import { FolderTodoService } from './folder-todo.service';

describe('FolderTodoService', () => {
  let service: FolderTodoService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(FolderTodoService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
