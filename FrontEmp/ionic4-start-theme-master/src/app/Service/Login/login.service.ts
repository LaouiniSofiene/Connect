import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions } from '@angular/http';
import { NavController } from '@ionic/angular';
import { Storage } from '@ionic/storage';
import { User } from 'src/app/Entity/user';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  public static user: User;
  constructor(private http: Http, private storage: Storage, public navCtrl: NavController) { }
  login(credentials) {
    
    console.log(credentials['value']);

    let headers = new Headers({ 'Content-Type': 'application/json' });
    let options = new RequestOptions({ headers: headers });
    return this.http.post(`http://192.168.1.4/Connect/Connect/Back/web/app_dev.php/logged`, credentials['value'], options);


  }
  Store(username) {
    console.log(username['value']);
    this.storage.set('username', username['value']);
    this.http.get(`http://192.168.1.4/Connect/Connect/Back/web/app_dev.php/getToken`).subscribe(res => {
      res = res.json();
      this.storage.set('token', res[0]);
    });

  }
  getcurrentuser() {
    this.storage.get('username').then(res => {
      console.log(res);
      this.http.get('http://192.168.1.4/Connect/Connect/Back/web/app_dev.php/employees/' + res + '/get_by_fos').subscribe(res => {
        res = res.json();
        console.log(res);
        LoginService.user = new User();
        LoginService.user.id = res[0]['id'];
        LoginService.user.cin = res[0]['cin'];
        LoginService.user.first_name = res[0]['firstName'];
        LoginService.user.last_name = res[0]['lastName'];
        LoginService.user.giveaccess = res[0]['giveaccess'] == 1 ? true : false;
        LoginService.user.payment = res[0]['payment'] == 1 ? true : false;
        LoginService.user.transfert = res[0]['transfert'] == 1 ? true : false;
        LoginService.user.verifyaccess = res[0]['verifyaccess'] == 1 ? true : false;
        LoginService.user.idService = res[0]['idservice']['id'];
        LoginService.user.nameService = res[0]['idservice']['lable'];
        
        console.log(LoginService.user);
        this.navCtrl.navigateRoot('/home-results');
      });
    });


  }
}
