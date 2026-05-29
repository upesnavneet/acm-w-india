import React from 'react';

export default function ArticleCard({ post, onNavigatePost }) {
  const handleClick = (e) => {
    e.preventDefault();
    onNavigatePost(post.slug);
  };

  return (
    <div className="large-6 medium-6 small-12 columns" style={{ marginBottom: '20px' }}>
      <div className="shadowed cta" style={{ height: '100%', background: '#fff', border: '1px solid #e3e3e3', borderRadius: '4px', overflow: 'hidden', display: 'flex', flexDirection: 'column' }}>
        <a 
          href={`#post/${post.slug}`} 
          onClick={handleClick}
          style={{ textDecoration: 'none', display: 'block' }}
        >
          {post.thumbnailUrl && (
            <div 
              className="post-thumbnail"
              style={{ 
                height: '180px', 
                backgroundImage: `url('${post.thumbnailUrl}')`,
                backgroundSize: 'cover',
                backgroundPosition: 'center'
              }}
            />
          )}
        </a>
        
        <div style={{ padding: '15px', flex: 1, display: 'flex', flexDirection: 'column' }}>
          <span style={{ fontSize: '11px', textTransform: 'uppercase', letterSpacing: '1px', color: '#888', display: 'block', marginBottom: '5px' }}>
            {post.date} | By {post.author}
          </span>
          
          <a 
            href={`#post/${post.slug}`} 
            onClick={handleClick}
            style={{ textDecoration: 'none', color: '#005a83' }}
          >
            <h3 style={{ fontSize: '18px', fontWeight: 'bold', margin: '0 0 10px 0', lineHeight: '1.3', color: '#005a83' }}>
              {post.title}
            </h3>
          </a>
          
          <p className="dek" style={{ fontSize: '13px', lineHeight: '1.5', color: '#666', margin: '0 0 15px 0', flex: 1 }}>
            {post.excerpt}
          </p>
          
          <a 
            href={`#post/${post.slug}`} 
            onClick={handleClick}
            style={{ fontWeight: 'bold', fontSize: '13px', color: '#005a83', textDecoration: 'none', display: 'inline-flex', alignItems: 'center' }}
          >
            Read Full Article →
          </a>
        </div>
      </div>
    </div>
  );
}
