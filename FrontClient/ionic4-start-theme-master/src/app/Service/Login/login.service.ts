import { Injectable } from '@angular/core';
import {Http ,Headers, RequestOptions} from '@angular/http';
import { NavController } from '@ionic/angular';
import { Storage } from '@ionic/storage';
import { User } from 'src/app/Entity/user';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  public static user:User;
  constructor(private http: Http,private storage: Storage,public navCtrl: NavController) { }
  login(credentials)
  {
    
    console.log(credentials['value']);
    let headers = new Headers({ 'Content-Type': 'application/json' });
	  let options = new RequestOptions({ headers: headers });
    return this.http.post(`http://192.168.100.79/back/web/app_dev.php/logged`,credentials['value'], options);
    
    
  }
  Store(username)
  {
    console.log(username['value']);
    this.http.get(`http://192.168.100.79/back/web/app_dev.php/getToken`).subscribe(res=>{
      res=res.json();
      this.storage.set('token', res[0]);
    });

  }
  getcurrentuser(username)
  {  
     this.http.get('http://192.168.100.79/back/web/app_dev.php/clients/'+username+'/get_by_fos').subscribe(res=>{
        res=res.json();
        console.log(res);
        LoginService.user=new User();
        LoginService.user.cin=res[0]['cin'];
        LoginService.user.first_name=res[0]['firstName'];
        LoginService.user.last_name=res[0]['lastName'];
        LoginService.user.qrstring=res[0]['idAccount']['qrstring'];
        this.storage.set('qrstring',LoginService.user.qrstring);
        this.storage.set('username',res[0]['idfos']['username']);
        LoginService.user.numberaccess=res[0]['idAccount']['numberaccess'];
        LoginService.user.numberin=res[0]['idAccount']['numberin'];
        LoginService.user.experationdate=res[0]['idAccount']['expirationdate'];
        console.log(LoginService.user);
        this.navCtrl.navigateRoot('/home-results');
      });
    
  
  }
}
