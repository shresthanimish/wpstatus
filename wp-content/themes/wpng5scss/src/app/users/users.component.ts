import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import 'rxjs/add/operator/switchMap';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.scss']
})
export class UsersComponent implements OnInit {

  userid:number;
  isdetail:boolean;

  constructor() { }

  ngOnInit() {

    // this.userid = this.route.paramMap.source.value.id;

    // if(this.userid)
    //     this.isdetail = true;
    
  }

}
