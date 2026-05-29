import React from 'react';
import Breadcrumbs from '../components/Breadcrumbs';
import CommentsSection from '../components/CommentsSection';
import { mockPosts } from '../data/mockPosts';

export default function PostSingle({ slug, onNavigate }) {
  const post = mockPosts.find(p => p.slug === slug);

  if (!post) {
    return (
      <div className="row" style={{ padding: '40px 15px', textAlign: 'center' }}>
        <h2>Post Not Found</h2>
        <p>The requested article could not be found.</p>
        <button className="button" onClick={() => onNavigate('home')}>Back to Home</button>
      </div>
    );
  }

  return (
    <div>
      {/* Breadcrumbs */}
      <Breadcrumbs 
        paths={[
          { name: 'Articles', target: 'home' },
          { name: post.title, target: `post/${post.slug}` }
        ]} 
        onNavigate={onNavigate} 
      />

      <div id="maincontent" className="article row" tabIndex="-1" style={{ marginTop: '20px' }}>
        <div className="columns">
          <div className="row">
            
            {/* Full Post Article Content */}
            <article className="columns large-9 medium-9 small-12 blocks has-edit-button" id="SkipTarget">
              <span style={{ fontSize: '11px', textTransform: 'uppercase', letterSpacing: '1px', color: '#888', display: 'block', marginBottom: '8px' }}>
                Posted on {post.date} | By {post.author}
              </span>
              
              <h1 style={{ fontSize: '32px', color: '#333', fontWeight: 'bold', margin: '0 0 20px 0', borderBottom: '1px solid #ddd', paddingBottom: '10px' }}>
                {post.title}
              </h1>

              {post.thumbnailUrl && (
                <div 
                  className="post-feature-image" 
                  style={{ 
                    width: '100%', 
                    height: '350px', 
                    backgroundImage: `url('${post.thumbnailUrl}')`,
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                    borderRadius: '4px',
                    marginBottom: '20px'
                  }}
                />
              )}

              {/* Render html articles content safely */}
              <section 
                className="entry-content"
                dangerouslySetInnerHTML={{ __html: post.content }}
                style={{ fontSize: '15px', lineHeight: '1.7', color: '#444' }}
              />

              {/* Dynamic Comments Thread */}
              <CommentsSection targetId={post.id} />

            </article>

            {/* Right sidebar quick jumps to other articles */}
            <aside className="columns large-3 medium-3 show-for-medium-up" style={{ paddingLeft: '20px', borderLeft: '1px solid #eee' }}>
              <div className="widget">
                <h3 className="widget-title" style={{ borderBottom: '2px solid #005a83', paddingBottom: '5px', fontSize: '18px', color: '#333', marginTop: 0 }}>
                  Other Articles
                </h3>
                <ul style={{ listStyle: 'none', padding: 0 }}>
                  {mockPosts.filter(p => p.slug !== slug).map(p => (
                    <li key={p.id} style={{ marginBottom: '10px', fontSize: '13px' }}>
                      <a 
                        href={`#post/${p.slug}`}
                        onClick={(e) => { e.preventDefault(); onNavigate(`post/${p.slug}`); }}
                        style={{ color: '#005a83', textDecoration: 'none', fontWeight: 'bold' }}
                      >
                        {p.title}
                      </a>
                    </li>
                  ))}
                </ul>
              </div>
            </aside>

          </div>
        </div>
      </div>
    </div>
  );
}
