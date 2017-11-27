import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule } from '@angular/router';
import { AppComponent } from './app.component';

import { HomeComponent } from './home/home.component';
import { JudgeComponent } from './judge/judge.component';
import { InfoComponent } from './info/info.component';
import { PhotographerComponent } from './photographer/photographer.component';


@NgModule({
  declarations: [
    AppComponent,
    // MaterializeDirective,
    HomeComponent,
    JudgeComponent,
    InfoComponent,
    PhotographerComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    RouterModule.forRoot([
      {
        path: '',
        component: HomeComponent
      },
      {
        path: 'judge',
        component: JudgeComponent
      },
      {
        path: 'photographer',
        component: PhotographerComponent
      },
      {
        path: 'info',
        component: InfoComponent
      },
    ])
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
