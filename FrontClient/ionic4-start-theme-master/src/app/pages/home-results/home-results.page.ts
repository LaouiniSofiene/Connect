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
import { Observable } from 'rxjs';
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
  user: User = LoginService.user;
  products: any =[];
  showData:boolean=false;
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
  ) {
    this.storage.get("qrstring").then(
      val=>{console.log(val)
      if(val!=null)
      {
        this.showData=true;
        this.scannedData=val;
        setInterval(() => {
          this.getAmount();
        },1000);
      }
      });
  }
  getAmount()
  {console.log("loop");
    let form = {
      "Amount": this.amount,
      "Qrstring": this.scannedData
    }
    this.account.verifySold(form).subscribe(res=>{
      res=res.json();
      
      if(res[0]=='no')
      {
        console.log('ce compte est introuvable');
      }
      else
      {
        this.sold=parseInt(res[0]);
      }
    });
  }
  
  async notify(title,message)
  {
    const alert = await this.alertCtrl.create({
      header: title,
      message: message
      
    });

    await alert.present();
  }
  scanCode() {
    // console.log("okey1");
    // this.scannedData = 'testValue';
    // this.showData=true;
    // setInterval(() => {
      
    //   this.getAmount();
    // },1000);
    this.barcodeScanner
      .scan()
      .then(barcodeData => {
        alert("Barcode data " + JSON.stringify(barcodeData));
        this.scannedData = barcodeData;
        console.log(this.scannedData['text']);
        this.scannedData=this.scannedData['text'];
        this.showData=true;
        this.storage.set("qrstring",this.scannedData);
        setInterval(() => {
          this.getAmount();
        },1000);
      })
      .catch(err => {
        console.log("Error", err);
      });
  }

  encodedText() {
    this.encodeData=this.scannedData;
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
        this.notify('Valider','');
      }
      else
      {
        this.notify('non Valider','');
      }
    });
  }

}
