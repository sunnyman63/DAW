import { Component, OnInit, Output } from '@angular/core';
import { EventEmitter } from '@angular/core';
import { PartidaService } from 'src/app/services/partida.service';

@Component({
  selector: 'app-formulario',
  templateUrl: './formulario.component.html',
  styleUrls: ['./formulario.component.css']
})
export class FormularioComponent implements OnInit {

  jugadores: number = 0;

  @Output() actualizarEstado:EventEmitter<string> = new EventEmitter();

  constructor(private partidaService: PartidaService) { }

  ngOnInit(): void {
    this.jugadores = this.partidaService.getJugadores();
  }

  empezar(): void {
    if(this.jugadores != 0) {
      let modal = document.getElementsByClassName('modal-backdrop');
      modal[0].parentNode?.removeChild(modal[0]);
      this.partidaService.setIniciada(true);
      this.partidaService.setJugadores(this.jugadores);
      console.log(this.partidaService.getIniciada());
      console.log(this.partidaService.getJugadores());
      this.actualizarEstado.emit("iniciado");
    } 
    
  }

}
