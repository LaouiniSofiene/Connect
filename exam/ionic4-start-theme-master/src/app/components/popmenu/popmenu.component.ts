import { Component, OnInit } from '@angular/core';
import { NavController,Events } from '@ionic/angular';

@Component({
  selector: 'popmenu',
  templateUrl: './popmenu.component.html',
  styleUrls: ['./popmenu.component.scss']
})
export class PopmenuComponent implements OnInit {
  openMenu: Boolean = false;
  constructor(public navCtrl: NavController,
              public event: Events
    ) {
      
     }

  ngOnInit() {
  }

  togglePopupMenu() {
    return this.openMenu = !this.openMenu;
  }
  accessForm()
  {
    console.log('hey');
    this.event.publish('FormLoad' , 1);
  }
  verifyForm()
  {
    console.log('hey');
    this.event.publish('FormLoad' , 3);
  }
  transfertForm()
  {
    console.log('hey');
    this.event.publish('FormLoad' , 2);
  }
  paymentForm()
  {
    console.log('hey');
    this.event.publish('FormLoad' , 0);
  }
}
