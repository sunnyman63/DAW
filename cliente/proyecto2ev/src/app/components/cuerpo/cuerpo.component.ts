import { Component, OnInit } from '@angular/core';
import { partida } from 'src/app/models/partida';
import { PartidaService } from 'src/app/services/partida.service';

@Component({
  selector: 'app-cuerpo',
  templateUrl: './cuerpo.component.html',
  styleUrls: ['./cuerpo.component.css']
})
export class CuerpoComponent implements OnInit {
  
  partida:partida = new partida();

  constructor(private partidaService: PartidaService) { }

  ngOnInit(): void {
    this.partida = this.partidaService.getPartida();
  }

  actualizarEstado(value: string) {
    if(value == "iniciado") {
      this.partida = this.partidaService.getPartida();
    }
  }

}
