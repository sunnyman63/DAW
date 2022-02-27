import { Component } from '@angular/core';
import { partida } from './models/partida';
import { PartidaService } from './services/partida.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {

  partida:partida = new partida();
  actualizar: string = "";

  constructor(private partidaService:PartidaService) {

  }

  actualizarEstado(value: string) {
    if(value == "iniciado") {
      this.partida = this.partidaService.getPartida();
    }
  }
}
