import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {WordpressService} from '../wordpress.service';

@Component({
  selector: 'app-judge',
  templateUrl: './judge.component.html',
  styleUrls: ['./judge.component.css'],
  providers: [WordpressService]
})
export class JudgeComponent implements OnInit {
  title = 'Judge';

  ngOnInit() {
    // alert('inside judge component');
  }

}

