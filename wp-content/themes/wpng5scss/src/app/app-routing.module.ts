import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {PostsComponent} from "./posts/posts.component";
import {UsersComponent} from "./users/users.component";
import {SitesComponent} from "./sites/sites.component";

const routes: Routes = [
  { path: '', component: SitesComponent },
  { path: 'sites', component: SitesComponent },
  { path: 'posts', component: PostsComponent },
  { path: 'users', component: UsersComponent },
  { path: 'users/:id', component: UsersComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
