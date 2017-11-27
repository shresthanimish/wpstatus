import { Component, OnInit } from '@angular/core';
import {Category} from '../shared/interface/category';
import {WordpressService} from '../wordpress.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  //UnUsed
  //  categories = CATEGORIES;
  //  cardsperline = 3;
  //  columnsize = 12/this.cardsperline;
  //  categoryLength = this.categories.length;
  //  temp = Array;
  //  math = Math;

  categories:Category[];
  categorieslength:number;


  constructor(private _wp:WordpressService) {}

  ngOnInit() {
    this.getCategories();
  }

  getCategories(){
    //WP API: http://walkley-wp.local/wp-json/wp/v2/categories
    this._wp.apiRequestToRead('http://walkley-wp.local/wp-json/walkley/v1/categories/photocatagories/')
        .subscribe(
            (data) => {

              this.categories = data;
              this.categorieslength = data.length;

            },
            (error) => console.log(error)
        );
  }
}