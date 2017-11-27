import { Component } from '@angular/core';
import {WordpressService} from "./wordpress.service";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  providers:[WordpressService]
})
export class AppComponent {
  
  constructor(private _wp: WordpressService){}

  //title = this._wp.getSiteName();
  title = 'Site';

}
