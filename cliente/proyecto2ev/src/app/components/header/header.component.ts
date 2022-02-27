import { Component, Input, OnInit } from '@angular/core';
import { partida } from 'src/app/models/partida';
import { PartidaService } from 'src/app/services/partida.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

  @Input() partida: partida = new partida();
  constructor(private partidaService:PartidaService) { }

  ngOnInit(): void {
    this.partida = this.partidaService.getPartida();
  }

  actualizarEstado(value: string) {
    if(value == "iniciado") {
      this.partida = this.partidaService.getPartida();
    }
  }

  partidaNueva() {
    window.location.reload();
  }

}
