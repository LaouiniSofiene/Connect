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
import { User } from '../../Entity/user';
import { LoginService } from 'src/app/Service/Login/login.service';
import { AccountService } from 'src/app/Service/Account/account.service';
import { ProductService } from 'src/app/Service/Product/product.service';
import { TransactionService } from 'src/app/Service/Transaction/transaction.service';
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
  Payment: boolean;
  Transfert: boolean;
  VerifyAccess: boolean;
  GiveAccess: boolean;
  amount: any;
  numberaccess: any;
  user: User = LoginService.user;
  products: any =[];
  constructor(
    public navCtrl: NavController,
    public menuCtrl: MenuController,
    public popoverCtrl: PopoverController,
    public alertCtrl: AlertController,
    public modalCtrl: ModalController,
    public toastCtrl: ToastController,
    public event: Events,
    public storage: Storage,
    private barcodeScanner: BarcodeScanner,
    private account: AccountService,
    public loadingCtrl: LoadingController,
    public product:ProductService,
    public transaction:TransactionService,
  ) {
    
    this.encodeData = "https://www.FreakyJolly.com";
    //Options
    this.barcodeScannerOptions = {
      showTorchButton: true,
      showFlipCameraButton: true
    };
    event.subscribe('FormLoad', a => {
      this.amount=null;
      this.scannedData=null;
      this.numberaccess=null;
      console.log('event pass');
      if (a == 0) {
        console.log('if passe');
        this.products=[];
        this.product.getproducts().subscribe(res=>{
          let productsjson=JSON.parse(JSON.stringify(res.json()));
            productsjson.forEach(element => {
            this.products.push(JSON.parse(JSON.stringify(element)));
            
          });
          
        });
        this.Payment = true;
        this.GiveAccess = false;
        this.Transfert = false;
        this.VerifyAccess = false;
      }
      else if (a == 1) {
        this.Payment = false;
        this.GiveAccess = true;
        this.Transfert = false;
        this.VerifyAccess = false;

      }
      else if (a == 2) {
        this.Payment = false;
        this.GiveAccess = false;
        this.Transfert = true;
        this.VerifyAccess = false;

      }
      else if (a == 3) {
        this.Payment = false;
        this.GiveAccess = false;
        this.Transfert = false;
        this.VerifyAccess = true;

      }

    });
    //this.GiveAccess = true;
  }
  addtoAddition(product)
  {
    this.amount+=product.price;
  }
  giveAccess() {
    let form = {
      "Amount": this.amount,
      "Numberaccess": this.numberaccess,
      "Qrstring": this.scannedData
    }
    this.account.existAccount(form).subscribe(res => {
      res = res.json();
      if (res[0] == 'yes') {
        
        this.notify("Carte déja utilisée","Cette carte est déja liée a un compte");
      }
      else {
        this.account.giveAccess(form);
        this.notify("Compte Crée","le compte a été crée ");
        this.transaction.record(
          {
            "qrstring":this.scannedData,
            "idemployee":LoginService.user.id,
            "amount":this.amount
          }
        );
      }
    });
    
  }
  verifyform()
  {
    if(this.amount==null)
    {
      return false;
    }
     
    if(this.scannedData==null)
      {return false;
      }
    return true;
  }
  in() {

    let form = {
      "Amount": this.amount,
      "Qrstring": this.scannedData
    }
    if(this.verifyform()==true)
    {
      this.account.existAccount(form).subscribe(res => {
        res = res.json();
        if (res[0] == 'yes') {
          
          this.account.add(form);
          this.notify("Alimentation","Le compte a été alimenter de : "+this.amount+"dt");
          this.transaction.record(
            {
              "qrstring":this.scannedData,
              "idemployee":LoginService.user.id,
              "amount":this.amount
            }
          );
        }
        else {
          this.notify("compte introuvable","le code scanner n'est lié a aucun compte");

        }
      });
    }
    

  }
  async notify(title,message)
  {
    const alert = await this.alertCtrl.create({
      header: title,
      message: message
      
    });

    await alert.present();
  }
  out() {
    let form = {
      "Amount": this.amount,
      "Qrstring": this.scannedData
    }
    this.account.existAccount(form).subscribe(res => {
      res = res.json();
      if (res[0] == 'yes') {
        this.account.verifySold(form).subscribe(res=>{
          res=res.json();
          let sold=parseInt(res[0]);
          
          if(sold-this.amount>=0)
          {
            this.account.getpayed(form);
            this.notify("Pay","la somme de "+this.amount+"dt a été retirer du compte");
            this.transaction.record(
              {
                "qrstring":this.scannedData,
                "idemployee":LoginService.user.id,
                "amount":this.amount*-1
              }
            );
          }
          else
          {
            this.notify("Sold insufisant","il vous reste la somme de : "+sold);
          }
        });
        
      }
      else {
        this.notify("compte introuvable","le code scanner n'est lié a aucun compte");

      }
    });
  }
  scanCode() {
    this.barcodeScanner
      .scan()
      .then(barcodeData => {
        this.scannedData = barcodeData;
        this.scannedData=this.scannedData['text'];
      })
      .catch(err => {
        console.log("Error", err);
      });
  }

  encodedText() {
    this.barcodeScanner
      .encode(this.barcodeScanner.Encode.TEXT_TYPE, this.encodeData)
      .then(
        encodedData => {
          console.log(encodedData);
          this.encodeData = encodedData;
        },
        err => {
          console.log("Error occured : " + err);
        }
      );
  }

  ionViewWillEnter() {
    this.menuCtrl.enable(true);
  }


  settings() {
    this.navCtrl.navigateForward('settings');
  }

  async alertLocation() {
    const changeLocation = await this.alertCtrl.create({
      header: 'Change Location',
      message: 'Type your Address.',
      inputs: [
        {
          name: 'location',
          placeholder: 'Enter your new Location',
          type: 'text'
        },
      ],
      buttons: [
        {
          text: 'Cancel',
          handler: data => {
            console.log('Cancel clicked');
          }
        },
        {
          text: 'Change',
          handler: async (data) => {
            console.log('Change clicked', data);
            this.yourLocation = data.location;
            const toast = await this.toastCtrl.create({
              message: 'Location was change successfully',
              duration: 3000,
              position: 'top',
              closeButtonText: 'OK',
              showCloseButton: true
            });

            toast.present();
          }
        }
      ]
    });
    changeLocation.present();
  }

  async searchFilter() {
    const modal = await this.modalCtrl.create({
      component: SearchFilterPage
    });
    return await modal.present();
  }

  async presentImage(image: any) {
    const modal = await this.modalCtrl.create({
      component: ImagePage,
      componentProps: { value: image }
    });
    return await modal.present();
  }

  async notifications(ev: any) {
    const popover = await this.popoverCtrl.create({
      component: NotificationsComponent,
      event: ev,
      animated: true,
      showBackdrop: true
    });
    return await popover.present();
  }
  verifyAccess()
  {
    let form = {
      "Amount": this.amount,
      "Qrstring": this.scannedData
    }
    this.account.existAccount(form).subscribe(res=>{
      res=res.json();
      if(res[0]=='yes')
      {
        this.account.goin(form).subscribe(res=>{
          res=res.json();
          if(res[0]!='no')
          {
            this.notify('Valider','');
          }
          else
          {
            this.notify('no access','');
          }
        });
        
      }
      else
      {
        this.notify('non Valider','');
      }
    });
   

  }

}
