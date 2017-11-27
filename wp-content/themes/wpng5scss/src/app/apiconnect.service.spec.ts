import { TestBed, inject } from '@angular/core/testing';

import { ApiConnectService } from './apiconnect.service';

describe('ApiConnectService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [ApiConnectService]
    });
  });

  it('should be created', inject([ApiConnectService], (service: ApiConnectService) => {
    expect(service).toBeTruthy();
  }));
});
