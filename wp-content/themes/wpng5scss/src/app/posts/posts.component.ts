import { Component, OnInit } from '@angular/core';
import {ApiConnectService} from "../apiconnect.service";

@Component({
  selector: 'app-posts',
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.scss'],
  providers: [ApiConnectService]
})
export class PostsComponent implements OnInit {

  posts: Object[];
  postsLength: number;
  constructor(private _posts:ApiConnectService) {}

  ngOnInit() {
    this.getPosts();
  }

  getPosts(){
    // alert('hello');
    console.log('hello');
    this._posts.apiRequestToRead('https://jsonplaceholder.typicode.com/posts')
        .subscribe(
            (data) => {

              this.posts = data;
              this.postsLength = data.length;

              console.log(data);
            },
            (error) => console.log(error)
        );
  }
  
}
