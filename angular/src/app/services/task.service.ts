import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import "rxjs/add/operator/map";
import { Observable } from 'rxjs/Observable';
import { GLOBAL } from './global';

@Injectable()
export class TaskService {
  public url: string;

  constructor(
    private _http: Http
  ) {
    this.url = GLOBAL.url;
  }

  create(token, task) {
    let json = JSON.stringify(task);
    let params = "json=" + json + "&authorization=" + token;
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });

    return this._http.post(this.url + '/task/new', params, { headers: headers })
      .map(res => res.json());
  }

  getTasks(token, page = null) {
    let params = "authorization=" + token;
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });

    if (page == null) {
      page = 1;
    }

    return this._http.post(this.url + '/task/list?page=' + page, params, { headers: headers })
      .map(res => res.json());
  }

  getTask(token, id) {
    let params = "authorization=" + token;
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });

    return this._http.post(this.url + '/task/detail/' + id, params, { headers: headers })
      .map(res => res.json());
  }

  update(token, task, id) {
    let json = JSON.stringify(task);
    let params = "json=" + json + "&authorization=" + token;
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });

    return this._http.post(this.url + '/task/edit/' + id, params, { headers: headers })
      .map(res => res.json());
  }

  search(token, search = null, filter = null, order = null) {
    let params = "authorization=" + token + "&filter=" + filter + "&order=" + order;
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });

    let url: string;
    if (search == null) {
      url = this.url + '/task/search';
    } else {
      url = this.url + '/task/search/' + search;
    }

    return this._http.post(url, params, { headers: headers })
      .map(res => res.json());

  }


  deleteTask(token, id) {
    let params = "authorization=" + token;
    let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });

    return this._http.post(this.url + '/task/remove/' + id, params, { headers: headers })
      .map(res => res.json());
  }
}
