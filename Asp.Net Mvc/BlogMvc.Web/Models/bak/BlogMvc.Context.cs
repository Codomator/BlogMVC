﻿//------------------------------------------------------------------------------
// <auto-generated>
//     Ce code a été généré à partir d'un modèle.
//
//     Des modifications manuelles apportées à ce fichier peuvent conduire à un comportement inattendu de votre application.
//     Les modifications manuelles apportées à ce fichier sont remplacées si le code est régénéré.
// </auto-generated>
//------------------------------------------------------------------------------

namespace BlogMvc.Web.Models
{
    using System;
    using System.Data.Entity;
    using System.Data.Entity.Infrastructure;
    
    public partial class BlogMvcContainer : DbContext
    {
        public BlogMvcContainer()
            : base("name=BlogMvcContainer")
        {
        }
    
        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            throw new UnintentionalCodeFirstException();
        }
    
        public virtual DbSet<Categories> CategoriesSet { get; set; }
        public virtual DbSet<Comments> CommentsSet { get; set; }
        public virtual DbSet<Posts> PostsSet { get; set; }
        public virtual DbSet<Users> UsersSet { get; set; }
    }
}
