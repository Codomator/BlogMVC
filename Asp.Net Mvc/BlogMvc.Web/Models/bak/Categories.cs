//------------------------------------------------------------------------------
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
    using System.Collections.Generic;
    
    public partial class Categories
    {
        public Categories()
        {
            this.Posts = new HashSet<Posts>();
        }
    
        public int Id { get; set; }
        public string name { get; set; }
        public string slug { get; set; }
        public string post_count { get; set; }
    
        public virtual ICollection<Posts> Posts { get; set; }
    }
}
