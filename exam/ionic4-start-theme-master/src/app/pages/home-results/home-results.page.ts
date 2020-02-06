import { Component } from '@angular/core';
import {
  NavController,
  AlertController,
  MenuController,
  ToastController,
  PopoverController,
  ModalController,
  Events,LoadingController
} from '@ionic/angular';
// Modals
import { SearchFilterPage } from '../../pages/modal/search-filter/search-filter.page';
import { ImagePage } from './../modal/image/image.page';
// Call notifications test by Popover and Custom Component.
import { NotificationsComponent } from './../../components/notifications/notifications.component';
//QRCode
import {
  BarcodeScannerOptions,
  BarcodeScanner
} from "@ionic-native/barcode-scanner/ngx";
//SqlLite
import { Storage } from '@ionic/storage';
import { store, text } from '@angular/core/src/render3';
import { AccountService } from 'src/app/Service/Account/account.service';
import { ProductService } from 'src/app/Service/Product/product.service';
import { Observable } from 'rxjs';
import { Voiture } from 'src/app/Entity/voiture';
import { Reservation } from 'src/app/Entity/reservation';
@Component({
  selector: 'app-home-results',
  templateUrl: './home-results.page.html',
  styleUrls: ['./home-results.page.scss']
})
export class HomeResultsPage {
  searchKey = '';
  yourLocation = '123 Test Street';
  themeCover = 'assets/img/ionic4-Start-Theme-cover.jpg';
  encodeData: any;
  scannedData: {};
  barcodeScannerOptions: BarcodeScannerOptions;
  amount: any;
  sold:any=null;
  numberaccess: any;

  res:boolean=false;
  util:boolean=true;
  loisirs:boolean=false;
  reservationForm:boolean=false;

  nombrejour:Int16Array;
  cin:String;
  name:String;
  chauffeur:boolean;

  SelectedVoiture:any;
  voitures : Array<Voiture>;
  reservations:Array<Reservation>=new Array<Reservation>();
  constructor(
    public navCtrl: NavController,
    public menuCtrl: MenuController,
    public popoverCtrl: PopoverController,
    public alertCtrl: AlertController,
    public modalCtrl: ModalController,
    public toastCtrl: ToastController,
    public event: Events,
    public storage: Storage,
    public loadingCtrl: LoadingController,
    public product:ProductService,
  ) {
    
  }
  
  ngOnInit() {
    this.initVoiture();
  }
  initVoiture()
  {
    this.voitures=new Array<Voiture>();
    this.voitures.push(new Voiture('U','volksWagen Caddy',110,'Diesel',9,25));
    this.voitures.push(new Voiture('U','Peugeot Partener',90,'Diesel',7,25));
    this.voitures.push(new Voiture('U','Fiat Doblo',90,'Diesel',7,25));
    this.voitures.push(new Voiture('U','Mercedes Crafter',130,'Diesel',12,35));

    
    this.voitures.push(new Voiture('L','Peugeot 301',70,'Essence',5,50));
    this.voitures.push(new Voiture('L','Citroen C5',100,'Essenece',9,50));
    this.voitures.push(new Voiture('L','volksWagen Passat',110,'Diesel',9,50));
    this.voitures.push(new Voiture('L','Mercedes C180',110,'Essence',11,50));
  }
  async notify(title,message)
  {
    const alert = await this.alertCtrl.create({
      header: title,
      message: message
      
    });

    await alert.present();
  }
  LOGOUT()
  {
    console.log('Logout');
    this.navCtrl.navigateRoot('/');
  }
  loadUtil()
  {
    this.util=true;
    this.loisirs=false;
    this.res=false;
    this.reservationForm=false;
    console.log('Util');
  }
  loadLoisirs()
  {
    this.util=false;
    this.loisirs=true;
    this.res=false;
    this.reservationForm=false;
    console.log('Loisirs');
  }
  loadRes()
  {
    this.util=false;
    this.loisirs=false;
    this.res=true;
    this.reservationForm=false;
    console.log('Res');
  }
  reserver(v)
  {
    this.util=false;
    this.loisirs=false;
    this.res=false;
    this.reservationForm=true;
    this.SelectedVoiture=v;
    console.log(v);
  }
  rese()
  {
    
  }

}
