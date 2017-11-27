import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';

import { Observable } from 'rxjs/Observable';

import 'rxjs/add/operator/map';

import { Judge } from './judge';

@Injectable()
export class JudgeService {

    private _wpBase = "http://walkley-wp.local/wp-json/wp/v2/";


    constructor(private http: Http) { }


}
