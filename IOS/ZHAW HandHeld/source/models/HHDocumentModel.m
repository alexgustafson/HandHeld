//
//  HHDocumentModel.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 12.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "HHDocumentModel.h"


@implementation HHDocumentModel
@synthesize id;
@synthesize name;
@synthesize last_publication_date;
@synthesize version;
@synthesize startArticle;

- (id)initWithDBManager:(SqLiteDatabaseManager *)dbManager andDocumentArray:(NSArray *)documentArray
{
    self = [super init];
    if (self) {
        
        _dbManager = dbManager;
        [self setName:[documentArray valueForKey:@"name"]];
        
        NSNumber *articleID = [NSNumber numberWithInt:[[documentArray valueForKey:@"start_article"] intValue]];
        HHArticleModel* article = [[HHArticleModel alloc] initWithDBManager:_dbManager andDocumentArray:[_dbManager getArticleArrayForArticleID:articleID]];
        
        
        [self setStartArticle:[article autorelease]];
        
    }
    return self;
}

-(HHDocumentModel *)createDocumentFromArray:(NSArray *)documentArray
{
    HHDocumentModel *newDocument = [[HHDocumentModel alloc] initWithDBManager:_dbManager];
    
    [newDocument setName:[documentArray valueForKey:@"name"]];
    [newDocument setStart_article:[documentArray valueForKey:@"start_article"]];
    
    return [newDocument autorelease];
}



@end
