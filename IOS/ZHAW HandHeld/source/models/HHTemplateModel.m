//
//  HHTemplateModel.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 12.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "HHTemplateModel.h"

@implementation HHTemplateModel
@synthesize name, id, isComposite, fields;

- (id)initWithDBManager:(SqLiteDatabaseManager *)dbManager andTemplateArray:(NSArray *)templateArray
{
    self = [super init];
    if (self) {
        
        _dbManager = dbManager;
        [self setName:[templateArray valueForKey:@"name"]];
        [self setId:[templateArray valueForKey:@"id"]];
        
        if ([[templateArray valueForKey:@"data"] isEqualToString:@"1"]) {
            [self setIsComposite:YES];
        }else{
            [self setIsComposite:NO];
        }
        
        NSArray *fields = [dbManager getFieldsForTemplateID:[self id]];
        
        for (NSString * fielD in fields) {
            NSLog(fielD);
        }
        
    }
    return self;
}


@end
