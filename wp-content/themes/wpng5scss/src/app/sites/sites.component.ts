import { Component, OnInit } from '@angular/core';
import {ApiConnectService} from "../apiconnect.service";

@Component({
  selector: 'app-sites',
  templateUrl: './sites.component.html',
  styleUrls: ['./sites.component.scss'],
  providers: [ApiConnectService]
  
})
export class SitesComponent implements OnInit {

  sites: Object[];
  sitesLength: number;
  constructor(private _sites:ApiConnectService) {}

  ngOnInit() {
    this.getPosts();
  }

  getPosts(){
    // alert('hello');
    console.log('hello');
    this._sites.apiRequestToRead('http://wpstatus.local/wp-json/wpstatus/v1/server')
        .subscribe(
            (data) => {

              this.sites = data;
              this.sitesLength = data.length;

              console.log(data);
            },
            (error) => console.log(error)
        );
  }

}
