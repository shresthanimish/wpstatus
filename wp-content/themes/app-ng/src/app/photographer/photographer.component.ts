import { Component, OnInit } from '@angular/core';
import {WordpressService} from '../wordpress.service';
import {Photographer} from './photographer';

@Component({
  selector: 'app-photographer',
  templateUrl: './photographer.component.html',
  styleUrls: ['./photographer.component.css'],
  providers: [WordpressService]
})
export class PhotographerComponent implements OnInit {

  request:string;
  photographers:Photographer[];
  photographerslength:number;

  constructor(private _wp:WordpressService) {}

  ngOnInit() {
    this.getPhotographers();
  }

  getPhotographers(){
    //WP API: http://walkley-wp.local/wp-json/wp/v2/categories
    this._wp.apiRequestToRead('http://walkley-wp.local/wp-json/walkley/v1/photographers')
        .subscribe(
            (data) => {

              this.photographers = data;
              this.photographerslength = data.length;

            },
            (error) => console.log(error)
        );
  }
}
