import { TestBed, inject } from '@angular/core/testing';
import { WordpressService } from './wordpress.service';

describe('WordpressService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [WordpressService]
    });
  });

  it('should ...', inject([WordpressService], (service: WordpressService) => {
    expect(service).toBeTruthy();
  }));
});
