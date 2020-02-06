import { Voiture } from "../voiture";

export class Reservation {
    public voiture:Voiture;
    public cin:String;
    public nb:Int16Array;
    public nom:String;
    constructor(v,c,n,nom)
    {
        this.voiture=v;
        this.cin=c;
        this.nb=n;
        this.nom=nom;
    }
}
