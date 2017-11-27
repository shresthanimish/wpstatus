import { Component, OnInit } from '@angular/core';
import {WordpressService} from '../wordpress.service';

@Component({
  selector: 'app-info',
  templateUrl: './info.component.html',
  styleUrls: ['./info.component.css'],
  providers: [WordpressService]
})
export class InfoComponent implements OnInit {
  routeBase = WordpressService.API_ROUTE_BASE;

  constructor() { }

  ngOnInit() {
  }

}
