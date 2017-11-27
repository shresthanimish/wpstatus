import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
//import { Comment } from '../model/comment';
import {Observable} from 'rxjs/Rx';

// Import RxJs required methods
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';

@Injectable()
export class ApiConnectService {

  public static API_ROUTE_BASE='wp-json/walkley/v1/';
  public static WP_API_ROUTE_BASE='wp-json/wp/v2/';

  constructor(private http: Http) { }

  getSiteName(){
    return 'Walkley Judging Wordpress';
  }

  getApiRouteBase(){
    return 'wp-json/walkley/v1'
  }

  apiRequestToRead( $request ){
    // ...using get request
    return this.http.get($request)
    // ...and calling .json() on the response to return data
        .map(res => res.json())
        //...errors if any
        .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
  }

}

