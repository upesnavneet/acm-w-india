import React, { useState } from 'react';

export default function CommentsSection({ targetId }) {
  const [comments, setComments] = useState([
    {
      id: 1,
      author: "Prof. Suresh Kumar",
      date: "May 18, 2026 at 10:45 AM",
      text: "This is a great initiative. The summer schools and leadership programs will be extremely beneficial for newly established student chapters in Tier-2 colleges."
    },
    {
      id: 2,
      author: "Sneha Patel",
      date: "May 20, 2026 at 2:15 PM",
      text: "Is there any registration fee for the Algorithms summer school, or is it fully sponsored by ACM India? Looking forward to applying!"
    }
  ]);
  
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [commentText, setCommentText] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!name || !commentText) return;

    const newComment = {
      id: Date.now(),
      author: name,
      date: new Date().toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
      }) + " at " + new Date().toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
      }),
      text: commentText
    };

    setComments([...comments, newComment]);
    setName('');
    setEmail('');
    setCommentText('');
  };

  return (
    <div id="comments" className="comments-area" style={{ marginTop: '40px', borderTop: '1px solid #ddd', paddingTop: '30px' }}>
      <h3 className="comments-title" style={{ fontSize: '20px', color: '#333', marginBottom: '20px' }}>
        {comments.length} Discussion Comment{comments.length === 1 ? '' : 's'}
      </h3>

      {/* Comments List */}
      <ol className="comment-list" style={{ listStyle: 'none', padding: 0 }}>
        {comments.map((comment) => (
          <li key={comment.id} style={{ borderBottom: '1px dashed #e3e3e3', paddingBottom: '15px', marginBottom: '15px' }}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '5px' }}>
              <strong style={{ color: '#005a83', fontSize: '15px' }}>{comment.author}</strong>
              <small style={{ color: '#888', fontSize: '12px' }}>{comment.date}</small>
            </div>
            <p style={{ fontSize: '13px', lineHeight: '1.5', color: '#555', margin: 0 }}>
              {comment.text}
            </p>
          </li>
        ))}
      </ol>

      {/* Comment Form */}
      <div id="respond" className="comment-respond" style={{ marginTop: '30px', background: '#fcfcfc', padding: '20px', borderRadius: '4px', border: '1px solid #eee' }}>
        <h4 className="comment-reply-title" style={{ fontSize: '16px', margin: '0 0 15px 0', color: '#333' }}>
          Leave a Reply
        </h4>
        <form onSubmit={handleSubmit} id="commentform" className="comment-form">
          <div style={{ display: 'flex', gap: '15px', flexWrap: 'wrap', marginBottom: '10px' }}>
            <div style={{ flex: '1 1 200px' }}>
              <label style={{ display: 'block', fontSize: '12px', fontWeight: 'bold', color: '#666', marginBottom: '3px' }}>Name *</label>
              <input 
                type="text" 
                required 
                value={name}
                onChange={(e) => setName(e.target.value)}
                style={{ width: '100%', padding: '6px 10px', fontSize: '13px', border: '1px solid #ccc', borderRadius: '4px' }}
              />
            </div>
            <div style={{ flex: '1 1 200px' }}>
              <label style={{ display: 'block', fontSize: '12px', fontWeight: 'bold', color: '#666', marginBottom: '3px' }}>Email</label>
              <input 
                type="email" 
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                style={{ width: '100%', padding: '6px 10px', fontSize: '13px', border: '1px solid #ccc', borderRadius: '4px' }}
              />
            </div>
          </div>
          <div style={{ marginBottom: '15px' }}>
            <label style={{ display: 'block', fontSize: '12px', fontWeight: 'bold', color: '#666', marginBottom: '3px' }}>Comment *</label>
            <textarea 
              rows="4" 
              required
              value={commentText}
              onChange={(e) => setCommentText(e.target.value)}
              style={{ width: '100%', padding: '8px 10px', fontSize: '13px', border: '1px solid #ccc', borderRadius: '4px', resize: 'vertical' }}
            />
          </div>
          <div>
            <button 
              type="submit" 
              className="button"
              style={{ padding: '8px 20px', background: '#005a83', color: '#fff', border: 'none', borderRadius: '4px', fontWeight: 'bold', cursor: 'pointer' }}
            >
              Post Comment
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
