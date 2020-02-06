import { Injectable } from '@angular/core';
import {Http ,Headers, RequestOptions} from '@angular/http';
import { Storage } from '@ionic/storage';
import { HomeResultsPage } from 'src/app/pages/home-results/home-results.page';
import { LoginPage } from 'src/app/pages/login/login.page';
import { LoginService } from 'src/app/Service/Login/login.service';
@Injectable({
  providedIn: 'root'
})
export class ProductService {

  constructor(private http: Http,
              private storage: Storage 
            ) { 
                  
            }
  getproducts()
  {
    console.log('good');
    return this.http.get('http://192.168.100.79/back/web/app_dev.php/product');
  }
}
