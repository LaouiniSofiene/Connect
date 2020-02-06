import { Injectable } from '@angular/core';
import {Http ,Headers, RequestOptions} from '@angular/http';
import { Storage } from '@ionic/storage';
import { resolveTiming } from '@angular/animations/browser/src/util';
@Injectable({
  providedIn: 'root'
})
export class AccountService {

  constructor(
              private http: Http,
              private storage: Storage
              ) 
              {  }
  add(form)
  {
    this.http.get('http://192.168.1.4/Connect/Connect/Back/web/app_dev.php/accounts/'+form['Qrstring']+'/'+form['Amount']+'/in')
    .subscribe(res=>{console.log(res)});
  }
  getpayed(form)
  {
    this.http.get('http://192.168.1.4/Connect/Connect/Back/web/app_dev.php/accounts/'+form['Qrstring']+'/'+form['Amount']+'/out')
    .subscribe(res=>{console.log(res)});
  }
  verifyAccess(form)
  {

  }
  giveAccess(form)
  {
    let headers = new Headers({ 'Content-Type': 'application/json' });
    let options = new RequestOptions({ headers: headers });
    console.log(form);
    this.http.post('http://192.168.1.4/Connect/Connect/Back/web/app_dev.php/accounts/new',form,options).subscribe(res=>{
    });
  }
  existAccount(form)
  {
    return this.http.get('http://192.168.1.4/Connect/Connect/Back/web/app_dev.php/accounts/'+form['Qrstring']+'/exist');
  }
  verifySold(form)
  {
    return this.http.get('http://192.168.1.4/Connect/Connect/Back/web/app_dev.php/accounts/'+form['Qrstring']+'/sold');
  }
  goin(form)
  {
    return this.http.get('http://192.168.1.4/Connect/Connect/Back/web/app_dev.php/accounts/'+form['Qrstring']+'/in');
  }
}
